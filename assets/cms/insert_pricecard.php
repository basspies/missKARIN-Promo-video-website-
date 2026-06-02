<?php
include '../includes/conn.php';

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
				$stmt = $conn->prepare('INSERT INTO pricing_cards (title, tag, description, price, price_note, button_text, button_url, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
				$stmt->execute([$title, $tag, $description, $price, $price_note, $button_text, $button_url, $sort_order, $is_active]);
				$cardId = $conn->lastInsertId();

				// Insert features (one per line)
				$features = explode("\n", $_POST['features'] ?? '');
				// prefer `pricing_card_id` column name if present
				$col = in_array('pricing_card_id', $conn->query("SHOW COLUMNS FROM `pricing_card_features`")->fetchAll(PDO::FETCH_COLUMN)) ? 'pricing_card_id' : 'price_card_id';
				$fstmt = $conn->prepare("INSERT INTO pricing_card_features ({$col}, feature_text, sort_order) VALUES (?, ?, ?)");
				$i = 0;
				foreach ($features as $f) {
						$f = trim($f);
						if ($f === '') continue;
						$fstmt->execute([$cardId, $f, $i++]);
				}

				echo '<p>Price card inserted.</p>';
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
	<title>Insert Price Card</title>
</head>
<body class="cms-container">
	<div class="cms-content">
		<h1>Insert Price Card</h1>
		<form method="POST" action="">
			<label>Title</label><br>
			<input name="title" required><br>
			<label>Tag</label><br>
			<input name="tag"><br>
			<label>Description</label><br>
			<textarea name="description"></textarea><br>
			<label>Features (one per line)</label><br>
			<textarea name="features" rows="6"></textarea><br>
			<label>Price</label><br>
			<input name="price" type="number" step="0.01"><br>
			<label>Price note</label><br>
			<input name="price_note"><br>
			<label>Button text</label><br>
			<input name="button_text"><br>
			<label>Button URL</label><br>
			<input name="button_url"><br>
			<label>Sort order</label><br>
			<input name="sort_order" type="number" value="0"><br>
			<label><input type="checkbox" name="is_active" checked> Active</label><br><br>
			<button type="submit" class="btn btn-edit">Insert</button>
		</form>
	</div>
</body>
</html>
