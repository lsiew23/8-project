<?php

/*************************************************************************************************
 * library.php
 *
 * Common environment settings and functions used througout the Hanover DPW Park Permitting
 * application.
 *************************************************************************************************/
error_Reporting(0);
extract($_REQUEST);
session_start();

/*
 * Returns the content to be included based on the 'content' request parameter, if present.
 */
function get_content()
{
    global $content;

    if (!isset($content))
    {
        $content = 'list';
    }

    $content = 'hhs' . ucfirst(strtolower($content));

    return $content;
}

/*
 * Returns a connection to the underlying MySQL database.
 */
function get_database_connection()
{
    $servername = 'localhost';
    // TODO: Don't use 'root', make a separate user for this database
    $username = 'root';
    $password = '';
    $dbname = 'cyber_hawks_db';

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error)
    {
        die('Connection failed: ' . $conn->connect_error);
    }

    return $conn;
}


function hash_password($password)
{
    return '*' . strtoupper(hash('sha1', hex2bin(hash('sha1', $password))));
}
