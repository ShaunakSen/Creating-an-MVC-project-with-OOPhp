<?php
require 'classes/Database.php';
$database = new Database;
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if (isset($_POST['submit'])) {
    $title = $post['title'];
    $body = $post['body'];
    $database->query('INSERT INTO posts(title,body) VALUES (:title, :body)');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->execute();
    if ($database->lastInserId()) {
        echo '<div class="alert  alert-success" role="alert">Ok.. Inserted</div>';
    }
}

if (isset($_POST['submit_update'])) {
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $database->query('UPDATE posts SET title = :title, body = :body WHERE id=:id');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->bind(':id', $id);
    $database->execute();
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $database->query('DELETE FROM posts WHERE id = :id');
    $database->bind(':id', $delete_id);
    $database->execute();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="fonts/glyphicons-halflings-regular.ttf"/>
    <link rel="stylesheet" href="css/styles.css"/>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <?php
    $database->query('SELECT * FROM posts'); //query compiles only once .. now we can call it over and over again
    $rows = $database->resultset();
    ?>

    <div class="row">
        <br/><br/><br/>
        <div class="col-sm-6">
            <h3>Insert</h3>
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Enter Title"/>
                    <br/>
                    <textarea class="form-control" rows="3" name="body" placeholder="Enter Post Here..."></textarea>
                    <br/>
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
                    <br/>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <h3>Update</h3>
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                <div class="form-group">
                    <input type="number" class="form-control" name="id" placeholder="Enter id to update" min="1"/>
                    <br/>
                    <input type="text" class="form-control" name="title" placeholder="Enter Title"/>
                    <br/>
                    <textarea class="form-control" rows="3" name="body" placeholder="Enter Post Here..."></textarea>
                    <br/>
                    <input type="submit" name="submit_update" class="btn btn-danger" value="Submit"/>
                    <br/>
                </div>
            </form>
        </div>


    </div>

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
                <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>"/>
                    <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                </form>
            </div>

        <?php endforeach; ?>
    </div>


</div>

</body>
</html>

