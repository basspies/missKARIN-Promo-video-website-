<?php

include '../includes/conn.php';

$tableName = $_GET['table'] ?? null;
$id = $_GET['id'] ?? null;

if (!$tableName || !$id) {
    die('Table and ID are required');
}

// Basic whitelist check to prevent SQL injection via table name
try {
    $validTables = $conn->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
}

if (!in_array($tableName, $validTables)) {
    die('Invalid table name');
}

try {
    $stmt = $conn->prepare("SELECT * FROM `$tableName` WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Record not found');
    }

    $columns = array_keys($row);

} catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fields = [];
    $values = [];

    foreach ($columns as $col) {
        if ($col === 'id') continue;
        $fields[] = "`$col` = ?";
        $values[] = $_POST[$col] ?? '';
    }

    $values[] = $id;
    $setClause = implode(', ', $fields);

    try {
        $stmt = $conn->prepare("UPDATE `$tableName` SET $setClause WHERE id = ?");
        $stmt->execute($values);

        header('Location: cms.php');
        exit;

    } catch (PDOException $e) {
        die('Database error: ' . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $tableName))); ?></title>
    <link rel="stylesheet" href="./cms.css">
</head>

<body class="cms-container">

    <div class="cms-content">

        <h1>Edit <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $tableName))); ?></h1>

        <form method="POST">

            <?php foreach ($columns as $col): ?>
                <?php if ($col === 'id'): ?>
                    <?php /* skip id field */ ?>

                <?php elseif ($col === 'created_at' || $col === 'updated_at'): ?>
                    <label><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $col))); ?></label><br>
                    <input type="text" value="<?= htmlspecialchars($row[$col] ?? '') ?>" disabled>
                    <br><br>

                <?php elseif (str_contains($col, 'description') || str_contains($col, 'features') || str_contains($col, 'text')): ?>
                    <label for="<?= $col ?>"><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $col))); ?></label><br>
                    <textarea
                        id="<?= $col ?>"
                        name="<?= $col ?>"
                        rows="5"
                    ><?= htmlspecialchars($row[$col] ?? '') ?></textarea>
                    <br><br>

                <?php elseif ($col === 'is_active'): ?>
                    <label for="<?= $col ?>">Active</label><br>
                    <select id="<?= $col ?>" name="<?= $col ?>">
                        <option value="1" <?= ($row[$col] == 1) ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= ($row[$col] == 0) ? 'selected' : '' ?>>No</option>
                    </select>
                    <br><br>

                <?php else: ?>
                    <label for="<?= $col ?>"><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $col))); ?></label><br>
                    <input
                        type="text"
                        id="<?= $col ?>"
                        name="<?= $col ?>"
                        value="<?= htmlspecialchars($row[$col] ?? '') ?>"
                    >
                    <br><br>

                <?php endif; ?>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-edit">
                Update Record
            </button>

            <a href="cms.php" class="btn">
                Cancel
            </a>

        </form>

    </div>

</body>

</html>