<?php   
require_once("../../config/database.php");

    $id = $_GET["id"];
    $sql = "delete from khachhang where makh = '$id'";
    $kq = mysqli_query($conn, $sql);
    if($kq)
    {
        mysqli_close($conn);
        header("location: index.php");
    }
    else{
        echo " Xoa du lieu that bai!".mysqli_error($conn);
    }
?>