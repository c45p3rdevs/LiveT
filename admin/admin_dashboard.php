
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../public/index.php">Transmisiones</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../admin/login.php">Administrador</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-3">
                <li class="nav-item">
                <a class="nav-link" href="../public/register.php">Crear Cuenta </a>
                </li>
            </ul>

        </div>
    </nav>
    <?php
session_start();
include '../includes/config.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Mostrar lista de videos
$query = "SELECT * FROM videos ORDER BY created_at DESC";
$result = $conn->query($query);

echo "<h3>Gestión de Videos</h3>";
echo "<a href='upload_video.php' class='btn btn-success mb-3'>Subir Video</a>";

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Título</th><th>Acciones</th></tr></thead><tbody>";
    while ($video = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $video['title'] . "</td>";
        echo "<td>";
        echo "<a href='edit_video.php?id=" . $video['id'] . "' class='btn btn-primary btn-sm'>Editar</a> ";
        echo "<a href='delete_video.php?id=" . $video['id'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No hay videos disponibles.";
}
?>
</body>
</html>