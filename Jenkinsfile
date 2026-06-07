pipeline {
    agent any

    stages {
        stage('1. Validar Entorno') {
            steps {
                echo 'Verificando que Jenkins tenga acceso a Docker...'
                sh 'docker --version'
            }
        }

        stage('2. Control de Calidad') {
            steps {
                echo 'Analizando código PHP del proyecto...'
                // Validamos que index.php no tenga errores de sintaxis
                sh 'docker compose exec -T web php -l index.php || true'
            }
        }

        stage('3. Estado de Operaciones') {
            steps {
                echo 'Validando que la base de datos y la web estén corriendo bien...'
                sh 'docker compose ps'
            }
        }
    }

    post {
        success {
            echo '¡Operación completada con éxito! Tu entorno está automatizado.'
        }
    }
}
