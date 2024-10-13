<?php
include('config.php');

// Check if the 'id' is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the current data of the record based on the 'id'
    try {
        $sql = "SELECT * FROM myGuests WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC); // Get the record data
        } else {
            echo "Record not found.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}

// Check if the form is submitted for update
if (isset($_POST['update'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];

    try {
        $sql = "UPDATE myGuests SET first_name = :first_name, last_name = :last_name, email_address = :email_address WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email_address', $email_address);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
            // Redirect to index.php after successful update
            header("Location: index.php");
            exit;
        } else {
            echo "Error updating record.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!-- HTML Form to display and update the record -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
</head>
<body>
    <h2>Update Record</h2>
    <form method="POST">
        <label for="first_name">First Name:</label><br>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required><br><br>
        
        <label for="last_name">Last Name:</label><br>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required><br><br>
        
        <label for="email_address">Email Address:</label><br>
        <input type="email" name="email_address" value="<?php echo htmlspecialchars($row['email_address']); ?>" required><br><br>
        
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
