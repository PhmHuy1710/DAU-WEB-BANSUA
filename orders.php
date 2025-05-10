    <?php
    require_once('config/database.php');
    require_once('config/config.php');
    require_once('includes/session.php');

    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }

    require_once('layouts/client/header.php');
    $MaKH = $_SESSION['user']['MaKH'];
    
    $sql = "SELECT *
            from hoadon hd
            join khachhang kh on hd.MaKH = kh.MaKH
            where hd.MaKH = '$MaKH'
            order by hd.NgayLap desc";
    $result = mysqli_query($conn, $sql);
    

    ?>
    <?php
    require_once('layouts/client/footer.php');
    ?>