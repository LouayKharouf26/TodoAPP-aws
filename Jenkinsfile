pipeline{
    agent any
    stages{
        stage("getting code") {
            steps {
                git url: 'https://github.com/Louaykharouf26/ToDo-APP.git', branch: 'master',
                credentialsId: 'github-credentials' //jenkins-github-creds
                sh "ls -ltr"
            }
        }

       stage("Setting up infra") {
            steps {                
                script {
                    echo "======== executing ========"
                        sh "pwd"
                        sh "ls"
                        echo "terraform init"
                        sh "terraform init"
                        sh "terraform apply --auto-approve "     
                       }            
                        }
                    } 
        stage("Ansible configruation") {
            steps {                
                script {
                    echo "======== executing ========"
                        dir ("ansible")
                        sh "pwd"
                        sh "ls"
                        echo "update hosts"
                        sh "ansible-playbook update-hosts.yml"
                        echo "install dependencies "
                        sh "ansible-playbook -i hosts config-playbook.yml"
                        echo "configure the environement for the web app "
                        sh "ansible-playbook -i hosts web-app-config.yml"     
                       }            
                        }
                    }              
                }
            post{
                success{
                    echo "======== Setting up infra executed successfully ========"
                }
                failure{
                    echo "======== Setting up infra execution failed ========"
                }
            }
             
        }        
   /* 
    post{
        success{
            echo "========pipeline executed successfully ========"
        }
        failure{
            echo "========pipeline execution failed========"
        }
    }*/
