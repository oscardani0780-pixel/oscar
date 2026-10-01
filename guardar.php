<?php
// Datos de conexión obtenidos de las Variables de Entorno de Render (conectado a Railway)
$host = getenv('DB_HOST');
$port = (int) getenv('DB_PORT');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $name, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Obtener los datos enviados por el formulario de la encuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $matricula = $conn->real_escape_string($_POST['matricula']);
    $p1 = $conn->real_escape_string($_POST['p1']);
    $p2 = $conn->real_escape_string($_POST['p2']);
    $p3 = $conn->real_escape_string($_POST['p3']);
    $p4 = $conn->real_escape_string($_POST['p4']);
    $p5 = $conn->real_escape_string($_POST['p5']);

    // Insertar en la tabla llamada "encuesta" de tu base de datos en Railway
    $sql = "INSERT INTO encuesta (nombre, matricula, p1, p2, p3, p4, p5) VALUES ('$nombre', '$matricula', '$p1', '$p2', '$p3', '$p4', '$p5')";

    if ($conn->query($sql) === TRUE) {
        // Redirige a la página del regalo al terminar
        header("Location: regalo.html");
        exit();
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }
}

$conn->close();
?>