
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Video</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
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
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $video_url = $_POST['video_url'];

    $query = "INSERT INTO videos (title, description, video_url) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $title, $description, $video_url);

    if ($stmt->execute()) {
        echo "Video subido exitosamente.";
    } else {
        echo "Error al subir el video.";
    }
}
?>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Subir Nuevo Video</h3>
                    </div>
                    <div class="card-body">
                        <form action="upload_video.php" method="POST">
                            <div class="form-group">
                                <label for="title">Título del Video:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="video_url">URL del Video:</label>
                                <input type="text" class="form-control" id="video_url" name="video_url" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Subir Video</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
