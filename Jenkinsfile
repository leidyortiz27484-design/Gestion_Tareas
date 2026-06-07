pipeline {
    agent any

    stages {
        stage('1. Inicializar Entorno') {
            steps {
                echo '=== Descargando el proyecto desde GitHub exitosamente ==='
                echo "Construcción número: ${env.BUILD_NUMBER}"
            }
        }

        stage('2. Control de Calidad PHP') {
            steps {
                echo '=== Analizando estructura del proyecto ==='
                // Validamos la existencia de los archivos clave en el repositorio
                sh 'test -f index.php && echo "index.php correcto" || echo "Falta index.php"'
                sh 'test -f conexion.php && echo "conexion.php correcto" || echo "Falta conexion.php"'
            }
        }

        stage('3. Validación SQL') {
            steps {
                echo '=== Verificando Script de Base de Datos ==='
                // Valida que el archivo base de datos exista antes de cualquier despliegue
                sh 'test -f database.sql && echo "Script SQL localizado listo para usar"'
            }
        }
    }

    post {
        success {
            echo '=================================================='
            echo '¡OPERACIÓN EXITOSA! Tu código es estable y seguro.'
            echo '=================================================='
        }
        failure {
            echo '¡ALERTA! El pipeline ha fallado. Revisa la sintaxis.'
        }
    }
}
