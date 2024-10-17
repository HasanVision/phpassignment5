<?php
session_start();

$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
$release_date = filter_input(INPUT_POST, 'release_date');

// Convert the release date to the standard format for storage (Y-m-d)
if ($release_date) {
    $release_date = date('Y-m-d', strtotime($release_date));
}

// Check if required fields are filled
if ($code == NULL || $name == NULL || $version == NULL || $release_date == NULL) {
    $_SESSION['error_message'] = "Invalid product data. Check all fields and try again.";
    header("Location: add_product_form.php");
    die();
} else {
    try {
        require_once('../model/database.php');
        $query = 'INSERT INTO products (productCode, name, version, releaseDate)
                  VALUES (:code, :name, :version, :release_date)';

        $statement = $db->prepare($query);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':version', $version, PDO::PARAM_STR);
        $statement->bindValue(':release_date', $release_date);
        $statement->execute();
        $statement->closeCursor();

        header("Location: add_product_confirmation.php");
        die();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $_SESSION['error_message'] = "The product code already exists. Please use a unique product code.";
        } else {
            $_SESSION['error_message'] = "Database error: " . $e->getMessage();
        }
        header("Location: add_product_form.php");
        die();
    }
}
?>