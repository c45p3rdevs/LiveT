<?php
session_start();
include '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Obtener los detalles del video
    $query = "SELECT * FROM videos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $video = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $video_url = $_POST['video_url'];

        // Actualizar video
        $updateQuery = "UPDATE videos SET title = ?, description = ?, video_url = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('sssi', $title, $description, $video_url, $id);

        if ($stmt->execute()) {
            echo "Video actualizado exitosamente.";
            header('Location: admin_dashboard.php');
        } else {
            echo "Error al actualizar el video.";
        }
    }
} else {
    echo "No se ha proporcionado un ID de video.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Video</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Editar Video</h3>
        <form action="edit_video.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="title">Título del Video:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $video['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $video['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="video_url">URL del Video:</label>
                <input type="text" class="form-control" id="video_url" name="video_url" value="<?php echo $video['video_url']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Video</button>
        </form>
    </div>
</body>
</html>
