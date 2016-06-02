<?php
require 'classes/Database.php';
$database = new Database;

$database->query('SELECT * FROM posts WHERE id = :id');
$database->bind(':id', 1);
$rows = $database->resultset();
?>
<h2>Posts</h2>

<div>
    <?php foreach ($rows as $row): ?>
        <div>
            <h3>
                <?php echo $row['title']; ?>
            </h3>

            <p>
                <?php echo $row['body']; ?>
            </p>
        </div>

    <?php endforeach; ?>
</div>