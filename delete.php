<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $sql = "DELETE FROM myGuests WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect to index.php after successful deletion
            header("Location: index.php");
            exit;
        } else {
            echo "Error deleting record.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No ID provided.";
}
?>
