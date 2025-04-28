<?php
try {
    $db_host = 'localhost';
    $db_name = 'db_milky';
    $db_user = 'root';
    $db_pass = '';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if (!$conn) {
        throw new Exception('Không thể kết nối đến cơ sở dữ liệu');
    }

    mysqli_set_charset($conn, 'utf8');

} catch (Exception $e) {
    die('Lỗi kết nối: ' . $e->getMessage());
}
?>
