<?php
include '../assets/includes/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $tableName = 'taallessen'; // change this to your actual table name
        $stmt = $conn->prepare("DELETE FROM $tableName WHERE id = ?");
        $stmt->execute([$id]);

        // Redirect back to cms.php after deletion
        header('Location: cms.php');
        exit();
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
} else {
    echo 'No ID provided.';
}
?>