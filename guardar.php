<?php
$servidor = "localhost";
$usuario = "root";     // Cambia esto según tu configuración de servidor local (XAMPP/WAMP)
$password = "12345678";        // Cambia esto si tu contraseña de MySQL es distinta
$base_datos = "encuesta";

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$p1 = $_POST['p1_instalaciones'] ?? '';
$p2 = $_POST['p2_profesores'] ?? '';
$p3 = $_POST['p3_nivel_academico'] ?? '';
$p4 = $_POST['p4_transporte'] ?? '';
$p5 = $_POST['p5_recomendacion'] ?? '';

// Insertar en la base de datos
$sql = "INSERT INTO respuestas_upvm (p1_instalaciones, p2_profesores, p3_nivel_academico, p4_transporte, p5_recomendacion) 
        VALUES ('$p1', '$p2', '$p3', '$p4', '$p5')";

if ($conexion->query($sql) === TRUE) {
    // Redirigir a la página de regalo al completar con éxito (Punto 9)
    header("Location: regalo.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
