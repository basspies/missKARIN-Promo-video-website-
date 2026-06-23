<?php
include '../includes/conn.php';

// Fetch pricing cards
try {
    $stmt = $conn->prepare('SELECT id, title, tag, price, price_note, is_active, sort_order FROM pricing_cards ORDER BY sort_order, id');
    $stmt->execute();
    $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $cards = [];
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./cms.css">
  <title>Price Cards — CMS</title>
</head>
<body class="cms-container">
  <div class="cms-content">
    <h1>Pricing Cards</h1>
    <p><a href="insert_pricecard.php" class="btn btn-edit">Insert New Price Card</a></p>
    <table>
      <thead>
        <tr><th>ID</th><th>Title</th><th>Tag</th><th>Price</th><th>Active</th><th>Sort</th><th>Actions</th></tr>
      </thead>
      <tbody>
      <?php foreach ($cards as $c): ?>
        <tr>
          <td><?php echo $c['id']; ?></td>
          <td><?php echo htmlspecialchars($c['title']); ?></td>
          <td><?php echo htmlspecialchars($c['tag']); ?></td>
          <td><?php echo htmlspecialchars($c['price']); ?></td>
          <td><?php echo $c['is_active'] ? 'Yes' : 'No'; ?></td>
          <td><?php echo $c['sort_order']; ?></td>
          <td>
            <a href="edit_pricecard.php?id=<?php echo $c['id']; ?>" class="btn btn-edit">Edit</a>
            <a href="delete_pricecard.php?id=<?php echo $c['id']; ?>" class="btn btn-delete" onclick="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
