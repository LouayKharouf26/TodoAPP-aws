provider "aws" {
  region     = "eu-west-3"
  access_key = var.access_key
  secret_key = var.secret_key
}

variable "cidr_blocks" {
  description = "CIDR blocks and name tags for VPC and subnets"
  type = list(object({
    cidr_block = string
    name       = string
  }))
}

variable "avail_zone" {
  default = "eu-west-3a"
}

resource "aws_vpc" "myapp-vpc" {
  cidr_block = var.cidr_blocks[0].cidr_block
  tags = {
    Name = var.cidr_blocks[0].name
  }
}

resource "aws_subnet" "myapp-subnet-1" {
  vpc_id            = aws_vpc.myapp-vpc.id
  cidr_block        = var.cidr_blocks[1].cidr_block
  availability_zone = var.avail_zone
  tags = {
    Name = var.cidr_blocks[1].name
  }
}

resource "aws_route_table" "myapp-route-table" {
  vpc_id = aws_vpc.myapp-vpc.id

  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.myapp-internet-gateway.id
  }
}

resource "aws_route_table_association" "myapp-route-table-assoc" {
  subnet_id      = aws_subnet.myapp-subnet-1.id
  route_table_id = aws_route_table.myapp-route-table.id
}

resource "aws_internet_gateway" "myapp-internet-gateway" {
  vpc_id = aws_vpc.myapp-vpc.id
}

resource "aws_security_group" "myapp-security-group" {
  vpc_id = aws_vpc.myapp-vpc.id

  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"] # Allow SSH from all IP addresses
  }
}

output "dev-vpc-id" {
  value = aws_vpc.myapp-vpc.id
}

output "dev-subnet-id" {
  value = aws_subnet.myapp-subnet-1.id
}

data "aws_ami" "ubuntu" {
  most_recent = true

  filter {
    name   = "name"
    values = ["ubuntu/images/hvm-ssd/ubuntu-jammy-22.04-amd64-server-*"]
  }

  filter {
    name   = "virtualization-type"
    values = ["hvm"]
  }

  owners = ["099720109477"] // Canonical
}

resource "aws_instance" "myapp-instance" {
  ami             = data.aws_ami.ubuntu.id
  instance_type   = "t2.micro"
  subnet_id       = aws_subnet.myapp-subnet-1.id
  associate_public_ip_address = true
  key_name        = "ec2keys"  # Assuming you have a key_name variable defined somewhere
    vpc_security_group_ids = [aws_security_group.myapp-security-group.id]  # Specify the security group here

  tags = {
    Name = "myapp-instance"
  }
}
