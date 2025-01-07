<!-- 07.01.2025 (c) Alexander Livanov -->
<?php
session_start();

require_once('creds.php');

date_default_timezone_set('Europe/Moscow');

function dbConnect()
{
    global $user, $passwd, $db_name;
    
    try {
        return new PDO('mysql:dbname=' . $db_name . ';host=localhost', $user, $passwd);
    } catch (PDOException $e) {
        echo ($e->getMessage());
    }
}

$db_connect = dbConnect();

function getServerTime()
{
    return date('d.m.Y H:i', time());
}
