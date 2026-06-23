<?php
include '../includes/conn.php';

$id = $_GET['id'] ?? null;
if (!$id) die('ID required');

try {
    $stmt = $conn->prepare('SELECT * FROM pricing_cards WHERE id = ?');
    $stmt->execute([$id]);
    $card = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$card) die('Not found');

    // detect column name for feature FK
    $col = in_array('pricing_card_id', $conn->query("SHOW COLUMNS FROM `pricing_card_features`")->fetchAll(PDO::FETCH_COLUMN)) ? 'pricing_card_id' : 'price_card_id';
    $fstmt = $conn->prepare("SELECT feature_text FROM pricing_card_features WHERE {$col} = ? ORDER BY sort_order");
    $fstmt->execute([$id]);
    $features = $fstmt->fetchAll(PDO::FETCH_COLUMN);
} catch (Exception $e) {
    die('DB error: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $tag = $_POST['tag'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $price_note = $_POST['price_note'] ?? '';
    $button_text = $_POST['button_text'] ?? '';
    $button_url = $_POST['button_url'] ?? '';
    $sort_order = $_POST['sort_order'] ?? 0;
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    try {
        $ustmt = $conn->prepare('UPDATE pricing_cards SET title=?, tag=?, description=?, price=?, price_note=?, button_text=?, button_url=?, sort_order=?, is_active=? WHERE id=?');
        $ustmt->execute([$title, $tag, $description, $price, $price_note, $button_text, $button_url, $sort_order, $is_active, $id]);

        // replace features
        $col = in_array('pricing_card_id', $conn->query("SHOW COLUMNS FROM `pricing_card_features`")->fetchAll(PDO::FETCH_COLUMN)) ? 'pricing_card_id' : 'price_card_id';
        $conn->prepare("DELETE FROM pricing_card_features WHERE {$col} = ?")->execute([$id]);
        $featuresIn = explode("\n", $_POST['features'] ?? '');
        $fins = $conn->prepare("INSERT INTO pricing_card_features ({$col}, feature_text, sort_order) VALUES (?, ?, ?)");
        $i = 0;
        foreach ($featuresIn as $f) {
            $f = trim($f);
            if ($f === '') continue;
            $fins->execute([$id, $f, $i++]);
        }

        echo '<p>Updated</p>';
    } catch (Exception $e) {
        echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./cms.css">
  <title>Edit Price Card</title>
</head>
<body class="cms-container">
  <div class="cms-content">
    <h1>Edit Price Card</h1>
    <form method="POST" action="">
      <label>Title</label><br>
      <input name="title" value="<?php echo htmlspecialchars($card['title']); ?>" required><br>
      <label>Tag</label><br>
      <input name="tag" value="<?php echo htmlspecialchars($card['tag']); ?>"><br>
      <label>Description</label><br>
      <textarea name="description"><?php echo htmlspecialchars($card['description']); ?></textarea><br>
      <label>Features (one per line)</label><br>
      <textarea name="features" rows="6"><?php echo htmlspecialchars(implode("\n", $features)); ?></textarea><br>
      <label>Price</label><br>
      <input name="price" type="number" step="0.01" value="<?php echo htmlspecialchars($card['price']); ?>"><br>
      <label>Price note</label><br>
      <input name="price_note" value="<?php echo htmlspecialchars($card['price_note']); ?>"><br>
      <label>Button text</label><br>
      <input name="button_text" value="<?php echo htmlspecialchars($card['button_text']); ?>"><br>
      <label>Button URL</label><br>
      <input name="button_url" value="<?php echo htmlspecialchars($card['button_url']); ?>"><br>
      <label>Sort order</label><br>
      <input name="sort_order" type="number" value="<?php echo htmlspecialchars($card['sort_order']); ?>"><br>
      <label><input type="checkbox" name="is_active" <?php if ($card['is_active']) echo 'checked'; ?>> Active</label><br><br>
      <button type="submit" class="btn btn-edit">Update</button>
    </form>
  </div>
</body>
</html>
