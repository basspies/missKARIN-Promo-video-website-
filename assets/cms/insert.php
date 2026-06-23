<?php
include '../includes/conn.php';

$tableName = 'taallessen';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    try {
        $stmt = $conn->prepare("INSERT INTO $tableName (name, price, description) VALUES (?, ?, ?)");
        $stmt->execute([$name, $price, $description]);
        echo '<p>Record inserted successfully!</p>';
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
  <title>Insert New Record</title>
</head>

<body class="cms-container">
  <div class="cms-content">
    <h1>Insert New Record</h1>
    <form method="POST" action="">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name" required><br><br>

      <label for="price">Price:</label><br>
      <input type="number" step="0.01" id="price" name="price" required><br><br>

      <label for="description">Description:</label><br>
      <textarea id="description" name="description" required></textarea><br><br>

      <button type="submit" class="btn btn-edit">Insert Record</button>
    </form>
  </div>
</body>

</html>