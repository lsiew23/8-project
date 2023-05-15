<?php

/*************************************************************************************************
 * authenticate.php
 *
 * Copyright 2018-2021
 *
 * Authenticates the user based on the provided email address and password (sent as request
 * parameters).
 *
 * - email      the user's email address
 * - password   the user's password
 *
 * This page returns the following HTTP status codes:
 *
 * - 200 if the credentials were authenticated successfully
 * - 401 if the credentials could not be authenticated
 *************************************************************************************************/
require_once '../library.php';
$conn = get_database_connection();
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, hash_password($password));
$sql = <<<SQL
SELECT user_id, user_email, user_password
FROM users
WHERE user_email = '{$email}'
AND user_password = '{$password}'
SQL;
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if ($count == 1)
{
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    session_start();

    $_SESSION['userId'] = $row['user_id'];
    $_SESSION['authenticated'] = true;

    session_write_close();

    http_response_code(200);
}
else
{
    http_response_code(401);
}
$conn->close();

header('Location: ../index.php?content=order');
