<?php
session_start();
include '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Eliminar video
    $query = "DELETE FROM videos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "Video eliminado exitosamente.";
        header('Location: admin_dashboard.php');
    } else {
        echo "Error al eliminar el video.";
    }
} else {
    echo "No se ha proporcionado un ID de video.";
}
?>
