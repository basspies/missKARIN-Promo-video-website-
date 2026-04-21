<?php
include '../includes/conn.php';

$tableName = 'taallessen'; // change this to your actual table name

$id = $_GET['id'] ?? null;

if (!$id) {
    die('ID is required');
}

try {
    // Fetch existing record
    $stmt = $conn->prepare("SELECT id, name, price, description FROM $tableName WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Record not found');
    }
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    try {
        $stmt = $conn->prepare("UPDATE $tableName SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $id]);
        echo '<p>Record updated successfully!</p>';
        // Optionally redirect back to cms.php
        // header('Location: cms.php');
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./cms.css">
  <title>Edit Record</title>
</head>

<body class="cms-container">
  <div class="cms-content">
    <h1>Edit Record</h1>
    <form method="POST" action="">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br><br>

      <label for="price">Price:</label><br>
      <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required><br><br>

      <label for="description">Description:</label><br>
      <textarea id="description" name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea><br><br>

      <button type="submit" class="btn btn-edit">Update Record</button>
    </form>
  </div>
</body>

</html>