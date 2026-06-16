<?php

include '../includes/conn.php';

try {
    // Get all table names from the database
    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="./cms.css">
  <title>CMS Dashboard</title>
</head>

<body class="cms-container">
  <div class="cms-content">
    <h1>CMS-Dashboard</h1>
    <p>Here you can manage your content.</p>
  </div>

  <?php foreach ($tables as $tableName): ?>

    <?php
    try {
        $stmt = $conn->prepare("SELECT * FROM `$tableName`");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $columns = !empty($rows) ? array_keys($rows[0]) : [];
    } catch (PDOException $e) {
        echo "<p>Error loading table <strong>$tableName</strong>: " . $e->getMessage() . "</p>";
        continue;
    }
    ?>

    <div class="cms-table-section">
      <h2><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $tableName))); ?></h2>

      <?php if (empty($rows)): ?>
        <p>No records found.</p>
      <?php else: ?>
        <table class="cms-table">
          <thead>
            <tr>
              <?php foreach ($columns as $col): ?>
                <th><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $col))); ?></th>
              <?php endforeach; ?>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
              <?php foreach ($columns as $col): ?>
                <td><?php echo htmlspecialchars($row[$col] ?? ''); ?></td>
              <?php endforeach; ?>
              <td>
                <div class="action-buttons">
                  <a class="btn btn-edit" href="edit.php?table=<?php echo urlencode($tableName); ?>&id=<?php echo $row['id']; ?>">Edit</a>
                  <a class="btn btn-delete" href="delete.php?table=<?php echo urlencode($tableName); ?>&id=<?php echo $row['id']; ?>">Delete</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>

  <?php endforeach; ?>

</body>