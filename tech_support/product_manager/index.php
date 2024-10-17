<?php
require('../model/database.php');

try {
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
} catch (PDOException $e) {
    echo 'Database Error: ' . $e->getMessage();
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Product Manager</title>
        <link rel="stylesheet" type="text/css" href="/phpassignment5/tech_support/main.css">
    </head>
<body>
    <?php
    include('../view/header.php');
    ?>
    <main>
    <h1>Product List</h1>
    <table>
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Name</th>
                <th>Version</th>
                <th>Release Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo htmlspecialchars($product['productCode']); ?></td>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><?php echo htmlspecialchars($product['version']); ?></td>
                <td>
                    <?php
                    // Format the release date as mm-dd-yyyy (without leading zeros)
                    $release_date = date('n-j-Y', strtotime($product['releaseDate']));
                    echo htmlspecialchars($release_date);
                    ?>
                </td>
                <td>
                    <form action="delete_product.php" method="post">
                        <input type="hidden" name="product_code" value="<?php echo htmlspecialchars($product['productCode']); ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/phpassignment5/tech_support/product_manager/add_product_form.php">Add product</a>
    <?php
    include('../view/footer.php');
    ?>
     </main>
</body>
</html>