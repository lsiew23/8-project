<?php

/*************************************************************************************************
 * save.php
 *
 * Page to save a single application. This page expects the following request paramaters to
 * be set:
 *
 * - ordId
 * - date
 * - name
 * - email
 *************************************************************************************************/

include('library.php');

$conn = get_database_connection();

// Sanitize all input values to prevent SQL injection exploits
$ordId = $conn->real_escape_string($ordId);
$date = $conn->real_escape_string($date);
$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$type = $conn->real_escape_string($type);
$quantity = $conn->real_escape_string($quantity);



// Determine if we need to create a new application or edit an existing application
if (empty($ordId))
{
    /*
     * This is a new application (INSERT operation)
     */

    // Step 1: Create the `customer` record
    $sql = <<<SQL
    INSERT INTO orders (ord_id, ord_name, ord_email, ord_date, ord_slice_quantity, ord_type)
        VALUES ('$ordId', '$name', '$email', '$date', '$quantity', '$type')
    SQL;

    if (!$conn->query($sql))
    {
        die('Error inserting order record: ' . $conn->error);
    }

    // Step 2: Create the `application` record

        
}
else
{
    /*
     * This is an existing application (UPDATE operation)
     */

    // Step 1: Update the `customer` record
    $sql = <<<SQL
    UPDATE customers
       SET ord_name = '$name'
           ord_email = '$email'
           ord_date = '$date'
           ord_slice_quantity = '$quantity'
           ord_type = '$type'
     WHERE ord_id = $ordId
    SQL;

    if (!$conn->query($sql))
    {
        die('Error updating order record: ' . $conn->error);
    }

}

$conn->close();

header('Location: index.php?content=order');