<?php
require_once('layouts/client/header.php');

$sql = "SELECT * FROM SanPham LIMIT 8";
$result = mysqli_query($conn, $sql);

// Hãng sữa
$brand_sql = "SELECT * FROM ThuongHieu ORDER BY TenTH";  
$brand_result = mysqli_query($conn, $brand_sql);
?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Hãng Sữa</h5>
                        <ul class="list-unstyled">
                            <?php
                            if (mysqli_num_rows($brand_result) > 0) {
                                while ($row = mysqli_fetch_assoc($brand_result)) {
                                    echo '<li><a href="products.php?brand=' . $row['MaTH'] . '" class="text-decoration-none">' . $row['TenTH'] . '</a></li>';
                                }
                            } else {
                                echo '<li>Không có hãng sữa nào.</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
require_once('layouts/client/footer.php');
?>