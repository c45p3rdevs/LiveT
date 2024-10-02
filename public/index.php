<?php
include '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Transmisiones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Transmisiones</a>
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Transmisión en Vivo</h2>
                <iframe width="100%" height="450" src="https://www.youtube.com/embed/xRPjKQtRXR8?si=A38hxEGjYLKWSgNF" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-md-4">
                <h2>Videos Anteriores</h2>
                <div class="list-group">
                    <?php
                    $query = "SELECT * FROM videos ORDER BY created_at DESC";
                    $result = $conn->query($query);
                    while ($video = $result->fetch_assoc()) {
                        echo "<a href='" . $video['video_url'] . "' class='list-group-item list-group-item-action'>";
                        echo $video['title'];
                        echo "</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
