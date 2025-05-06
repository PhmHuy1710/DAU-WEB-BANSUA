<?php
require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

// Get current page for navigation highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/css/main.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="./">
                    <span class="text-primary">Milky</span><span class="text-info">World</span>
                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <?php
                        $current_page = basename($_SERVER['PHP_SELF']);
                        $pages = [
                            'index.php' => ['name' => 'Trang Chủ', 'icon' => 'fa-home'],
                            'products.php' => ['name' => 'Sản Phẩm', 'icon' => 'fa-box'],
                            'about.php' => ['name' => 'Giới Thiệu', 'icon' => 'fa-info-circle'],
                            'contact.php' => ['name' => 'Liên Hệ', 'icon' => 'fa-envelope']
                        ];

                        foreach ($pages as $page => $data) {
                            $active = ($current_page == $page) ? 'active' : '';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link ' . $active . '" href="' . $page . '">';
                            echo '<i class="fas ' . $data['icon'] . ' me-1"></i> ' . $data['name'];
                            echo '</a></li>';
                        }
                        ?>
                    </ul>

                    <!-- Search Form -->
                    <form class="search-form d-flex me-3">
                        <input class="form-control" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>

                    <!-- User Actions -->
                    <div class="user-actions d-flex align-items-center">
                        <!-- Shopping Cart -->
                        <a href="cart.php" class="btn btn-outline-primary cart-icon me-2">
                            <i class="fas fa-shopping-cart"></i>
                            <?php
                            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                echo '<span class="cart-badge">' . count($_SESSION['cart']) . '</span>';
                            }
                            ?>
                        </a>

                        <?php if (isLoggedIn()): ?>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                    $user = getCurrentUser();
                                    $avatar = !empty($user['Avatar']) ? AVATAR_DIR . $user['Avatar'] : DEFAULT_IMAGE;
                                    ?>
                                    <img src="<?php echo $avatar; ?>" alt="Avatar" class="user-avatar">
                                    <span class="d-none d-md-inline ms-1"><?php echo $user['TenKH']; ?></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Tài khoản</a></li>
                                    <li><a class="dropdown-item" href="orders.php"><i class="fas fa-shopping-bag me-2"></i>Đơn hàng</a></li>
                                    <?php if (isAdmin()): ?>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="admin/"><i class="fas fa-cog me-2"></i>Quản trị</a></li>
                                    <?php endif; ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                                </ul>
                            </div>
                        <?php else: ?>

                            <a href="login.php" class="btn btn-outline-primary me-2"><i class="fas fa-sign-in-alt me-1"></i> Đăng nhập</a>
                            <a href="register.php" class="btn btn-primary"><i class="fas fa-user-plus me-1"></i> Đăng ký</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>