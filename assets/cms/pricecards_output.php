<?php
include __DIR__ . '/../includes/conn.php';

try {
    $stmt = $conn->prepare('SELECT id, title, tag, description, price, price_note, button_text, button_url FROM pricing_cards WHERE is_active = 1 ORDER BY sort_order, id LIMIT 3');
    $stmt->execute();
    $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $cards = [];
}

foreach ($cards as $card) {
    ?>
      <div class="price-card">
        <h3><?php echo htmlspecialchars($card['title']); ?></h3>
        <div class="price-tag"><?php echo htmlspecialchars($card['tag']); ?></div>
        <p><?php echo htmlspecialchars($card['description']); ?></p>
        <ul class="price-features">
        <?php
            try {
                // support both column names: `pricing_card_id` (your SQL) and `price_card_id` (older migration)
                $col = null;
                // detect which column exists
                $cinfo = $conn->query("SHOW COLUMNS FROM `pricing_card_features`")->fetchAll(PDO::FETCH_COLUMN);
                if (in_array('pricing_card_id', $cinfo)) {
                    $col = 'pricing_card_id';
                } elseif (in_array('price_card_id', $cinfo)) {
                    $col = 'price_card_id';
                } else {
                    $col = 'pricing_card_id';
                }
                $fstmt = $conn->prepare("SELECT feature_text FROM pricing_card_features WHERE {$col} = ? ORDER BY sort_order");
                $fstmt->execute([$card['id']]);
                $features = $fstmt->fetchAll(PDO::FETCH_COLUMN);
            } catch (Exception $e) {
                $features = [];
            }
            foreach ($features as $f) {
                if (trim($f) !== '') echo '<li>' . htmlspecialchars($f) . '</li>';
            }
        ?>
        </ul>
        <?php
            $priceDisplay = '';
            $rawPrice = isset($card['price']) ? (string)$card['price'] : '';
            if ($rawPrice !== '') {
                $clean = preg_replace('/[^\d\.,\-]/u', '', $rawPrice);
                // remove dot thousand-separators, convert comma to decimal point
                $tmp = str_replace('.', '', $clean);
                $tmp = str_replace(',', '.', $tmp);
                if ($tmp !== '' && is_numeric($tmp)) {
                    $num = (float)$tmp;
                    $priceDisplay = '€ ' . number_format($num, 0, ',', '.') . ',-';
                } else {
                    $priceDisplay = htmlspecialchars($rawPrice);
                }
            }
        ?>
        <div class="price-amount"><?php echo $priceDisplay; ?></div>
        <div class="price-note"><?php echo htmlspecialchars($card['price_note']); ?></div>
        <a href="<?php echo htmlspecialchars($card['button_url']); ?>" class="btn"><?php echo htmlspecialchars($card['button_text']); ?></a>
      </div>
    <?php
}

?>
