<?php
include '../includes/conn.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	try {
		$col = in_array('pricing_card_id', $conn->query("SHOW COLUMNS FROM `pricing_card_features`")->fetchAll(PDO::FETCH_COLUMN)) ? 'pricing_card_id' : 'price_card_id';
		$conn->prepare("DELETE FROM pricing_card_features WHERE {$col} = ?")->execute([$id]);
		$conn->prepare('DELETE FROM pricing_cards WHERE id = ?')->execute([$id]);
		header('Location: pricecards.php');
		exit();
	} catch (Exception $e) {
		echo 'Error: ' . htmlspecialchars($e->getMessage());
	}
} else {
	echo 'No ID provided.';
}
?>

