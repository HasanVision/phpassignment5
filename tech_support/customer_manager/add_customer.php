<?php
session_start();

$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');
$email = filter_input(INPUT_POST, 'email');
$address = filter_input(INPUT_POST, 'address');
$city = filter_input(INPUT_POST, 'city');
$state = filter_input(INPUT_POST, 'state');
$postal_code = filter_input(INPUT_POST, 'postal_code');
$country_code = filter_input(INPUT_POST, 'country_code');
$phone = filter_input(INPUT_POST, 'phone');
$password = filter_input(INPUT_POST, 'password');

if ($first_name == null || $last_name == null || $email == null || $address == null || $city == null || $state == null || $postal_code == null || $country_code == null || $phone == null || $password == null) {
    $_SESSION['error_message'] = "Invalid customer data. Check all fields and try again.";
    header("Location: ../errors/error.php");
    die();
} else {
    try {
        require_once('../model/database.php');
        
        // Correct INSERT INTO query for adding a new customer
        $query = 'INSERT INTO customers
                  (firstName, lastName, email, address, city, state, postalCode, countryCode, phone, password)
                  VALUES
                  (:first_name, :last_name, :email, :address, :city, :state, :postal_code, :country_code, :phone, :password)';

        $statement = $db->prepare($query);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postal_code', $postal_code);
        $statement->bindValue(':country_code', $country_code);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();

        // Store customer name in session for confirmation
        $_SESSION['first_name'] = $first_name;

        // Redirect to confirmation page
        header("Location: add_customer_confirmation.php");
        die();
    
    } catch (PDOException $e) {
        // Handle other database errors
        $_SESSION['error_message'] = "Database error: " . $e->getMessage();
        header("Location: ../errors/error.php");
        die();
    }
}
?>