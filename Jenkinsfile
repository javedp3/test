pipeline {
    agent any
    stages {
        stage("Composer Install") {
            steps {
               script {
                    try {
                        sh 'composer install'
                    } catch (Exception e) {
                        echo 'An error occurred'
                    }
               }
            }
        }
        stage("Clean Cache") {
            steps {
               sh 'php artisan cache:clear'
               sh 'php artisan config:clear'
               sh 'php artisan config:cache'
            }
        }
        stage("Run Tests") {
            steps {
                sh 'php artisan test'
            }
        }
    }
    post {
        success {
            sh 'cd "/var/lib/jenkins/workspace/hostelwala"'
            sh 'rm -rf artifact.zip'
            sh 'zip -r artifact . -x "*node_modules**"'
            sh 'scp /var/lib/jenkins/workspace/hostelwala/artifact.zip /home/ubuntu/artifact'
            sh 'rm -r /var/www/html/*'
            sh 'unzip -o /home/ubuntu/artifact/artifact.zip -d /var/www/html'
            script {
                try {
//                      sh 'cd /var'
//                      sh 'cd /var/www/html'
                     //sh 'chown -R :www-data ./'
//                      /var/www/html/storage/framework/cache/data/
                     sh 'chmod -R 777 /var/www/html/'
//                      sh 'chmod -R 777 '
                     sh 'composer dump-autoload'
                     sh 'php artisan config:cache'
                     sh 'php artisan cache:clear'
                     //sh 'rm -rf vendor/'
                    // sh 'composer install'
                } catch (Exception e) {
                     echo 'Some file permissions not there'
                }
            }
        }
    }
}
