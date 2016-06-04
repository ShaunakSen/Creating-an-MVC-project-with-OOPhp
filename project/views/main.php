<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Share Board</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../project/assets/css/styles.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Share Board</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo ROOT_URL ?>">Home</a></li>
                <li><a href="<?php echo ROOT_URL ?>Shares">Shares</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['is_logged_in'])): ?>
                    <li><a href="<?php echo ROOT_URL ?>">Welcome <?php echo $_SESSION['user_data']['name'] ?></a></li>
                    <li><a href="<?php echo ROOT_URL ?>/Users/logout">Log Out</a></li>
                <?php else: ?>
                    <li><a href="<?php echo ROOT_URL ?>/Users/login">Login</a></li>
                    <li><a href="<?php echo ROOT_URL ?>/Users/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="row">
        <?php
        require($view);
        ?>
    </div>
</div>

</body>
</html>