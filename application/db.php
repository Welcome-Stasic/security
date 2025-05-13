<?
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'CHOP';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die('Подключние к базе данные не установлено: ' . $conn->connect_error);
}
?>