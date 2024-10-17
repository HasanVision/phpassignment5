<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" type="text/css" href="/phpassignment5/tech_support/main.css">
        <title>Add customer - Confirmation</title>
    </head>
<body>
    <?php include ("header.php"); ?>
    <main>
        <div>
            <h2>Thank you for Adding/Updating customer information.</h2>
            <p><?php echo htmlspecialchars($_SESSION['first_name']); ?> has been added to your contact list.</p>
            
            <p><?php echo htmlspecialchars($_SESSION['first_name']); ?> has been updated in your contact list.</p>
        </div>
        <p><a href="index.php">Search Customers</a></p>
    </main>
    <?php include ("footer.php"); ?>
</body>
</html>