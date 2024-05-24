<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1>Add Review</h1>
        <form action="index.php?page=add_review" method="POST">
            <div class="form-group">
                <label for="product_id">Product ID:</label>
                <input type="text" id="product_id" name="product_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <input type="number" id="rating" name="rating" class="form-control" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label for="review">Review:</label>
                <textarea id="review" name="review" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
