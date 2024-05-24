<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php?page=home">Marketplace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=add_review_form">Add Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=track_visit&company_id=1">Track Visit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=top_products">Top Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=logout">Logout</a>
                </li>';
            } else {
                echo '
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=auth">Register/Login</a>
                </li>';
            }
            ?>
        </ul>
    </div>
</nav>
