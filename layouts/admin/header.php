<?php
require_once('../config/database.php');
require_once('../config/config.php');
require_once('../includes/session.php');

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="icon" type="image/x-icon" href="/assets/images/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/css/layouts.css" rel="stylesheet">
</head>

<body>
    <header class="site-header">
        <div class="header-container">
            <a href="./" class="logo">
                <span class="logo-primary">Milky</span><span class="logo-secondary">World</span>
            </a>

            <div class="mobile-toggle" id="mobileToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="main-nav" id="mainNav">
                <ul class="nav-list">
                    <?php
                    $pages = [
                        'index.php' => ['name' => 'Dashboard', 'icon' => 'fa-tachometer-alt'],
                        'products.php' => ['name' => 'Sản Phẩm', 'icon' => 'fa-box'],
                        'customers.php' => ['name' => 'Khách Hàng', 'icon' => 'fa-users'],
                        'orders.php' => ['name' => 'Đơn Hàng', 'icon' => 'fa-shopping-cart']
                    ];

                    foreach ($pages as $page => $data) {
                        $active = ($current_page == $page || ($current_page == '' && $page == 'index.php')) ? 'active' : '';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link ' . $active . '" href="' . $page . '">';
                        echo '<i class="fas ' . $data['icon'] . '"></i> ' . $data['name'];
                        echo '</a></li>';
                    }
                    ?>
                </ul>
                <div class="header-actions">


                    <div class="user-actions">


                        <?php if (isLoggedIn()): ?>
                            <div class="user-dropdown">
                                <button class="user-dropdown-btn" id="userDropdown">
                                    <?php
                                    $user = getCurrentUser();
                                    $avatar = !empty($user['Avatar']) ? AVATAR_DIR . $user['Avatar'] : DEFAULT_IMAGE;
                                    ?>
                                    <img src="../<?php echo $avatar; ?>" alt="Avatar" class="user-avatar">
                                    <span class="username"><?php echo $user['TenKH']; ?></span>
                                    <i class="fas fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu" id="userDropdownMenu">
                                    <li><a href="../index.php"><i class="fas fa-home"></i>Trang Chủ</a></li>

                                    <li class="divider"></li>
                                    <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>


        </div>
    </header>

    <script>
        document.getElementById('mobileToggle').addEventListener('click', function() {
            document.getElementById('mainNav').classList.toggle('active');
            this.classList.toggle('active');
        });

        if (document.getElementById('userDropdown')) {
            document.getElementById('userDropdown').addEventListener('click', function(e) {
                e.stopPropagation();
                document.getElementById('userDropdownMenu').classList.toggle('active');
                if (window.innerWidth <= 768) {
                    document.body.classList.toggle('dropdown-open');
                }
            });

            document.addEventListener('click', function() {
                if (document.getElementById('userDropdownMenu')) {
                    document.getElementById('userDropdownMenu').classList.remove('active');
                    document.body.classList.remove('dropdown-open');
                }
            });

            window.addEventListener('resize', function() {
                if (document.getElementById('userDropdownMenu') && window.innerWidth > 768) {
                    if (document.body.classList.contains('dropdown-open')) {
                        document.body.classList.remove('dropdown-open');
                    }
                }
            });
        }
    </script>

    <style>
        body.dropdown-open {
            overflow: hidden;
        }

        @media (max-width: 992px) {
            .main-nav.active {
                padding-bottom: 20px;
            }

            .dropdown-menu.active {
                z-index: 1500;
            }
        }
    </style>
</body>

</html>