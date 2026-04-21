<?php
include '../includes/conn.php';

try {
    $tableName = 'taallessen'; // change this to your actual table name
    $stmt = $conn->prepare("SELECT id, name, price, description FROM $tableName");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/style.css">
  <title>CMS Dashboard</title>
</head>


<body class="cms-container">
  <div class="cms-content">
    <h1>CMS-Dashboard</h1>
    <p>Here you can manage your content.</p>
  </div>
  <div class="cms-knop"></div>
  <div class="cms-inhoud"></div>

  <table class="cms-table">
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>price</th>
      <th>description</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($rows as $row):?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['price']; ?></td>
      <td><?php echo $row['description']; ?></td>
      <td>
        <div class="action-buttons">
          <a class="btn btn-edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
          <a class="btn btn-delete" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        </div>
      </td>
    </tr>
    <?php endforeach;?>
  </table>




</body>

</html>