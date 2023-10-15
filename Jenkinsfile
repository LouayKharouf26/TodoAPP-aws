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

       //stage("Setting up infra") 
         stage("creation de image"){
            steps {                
                script {
                    echo "======== executing ========"
                       dir("web-app"){
                        sh "pwd"
                        sh "ls"
                        sh "docker compose up"}
                     //   echo "terraform init"
                      //  sh "terraform init"
                       // sh "terraform apply --auto-approve "     
                       }            
                        }
                    } 
        stage("push to docker hub") {
            steps {                
                script {
                    echo "======== executing ========"
                        dir ("web-app"){
                        sh "pwd"
                        sh "ls"
                        echo "push to hub"
                        sh "docker tag web louaykharouf/todo-app:web"
                        sh "docker push louaykharouf/todo-app:web"
                       /* echo "install dependencies "
                        sh "ansible-playbook -i hosts config-playbook.yml"
                        echo "configure the environement for the web app "
                        sh "ansible-playbook -i hosts web-app-config.yml"     */
                       }    }        
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
