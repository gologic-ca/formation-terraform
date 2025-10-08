<?php
$host = getenv('MYSQL_HOSTNAME') ?: 'host.docker.internal';
$dbname = 'webapp';
$username = 'root';
$password = getenv('DB_PASSWORD') ?: '';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $mysqli = new mysqli($host, $username, $password, $dbname);
    $mysqli->set_charset('utf8');
} catch(mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
