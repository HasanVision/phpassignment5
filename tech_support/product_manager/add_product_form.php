<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="/phpassignment5/tech_support/main.css">
</head>
<body>
    <?php include('../view/header.php'); ?>
    <main>
        <h1>Add Product</h1>

        <?php if (isset($_SESSION['error_message'])): ?>
            <p style="color:red;"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
        <?php endif; ?>

        <form action="add_product.php" method="post" id="aligned">
            <label>Code:</label>
            <input type="text" name="code" value="<?php echo htmlspecialchars($code ?? ''); ?>"><br>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>"><br>

            <label>Version:</label>
            <input type="number" name="version" step="0.1" value="<?php echo htmlspecialchars($version ?? ''); ?>"><br>

            <label>Release Date:</label>
            <input type="date" name="release_date" value="<?php echo htmlspecialchars($release_date ?? ''); ?>"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Product"><br>
        </form>

        <p><a href="/phpassignment5/tech_support/product_manager">View Product List</a></p>
    </main>
    <?php include('../view/footer.php'); ?>
</body>
</html>