    <header>
        <a href="<?php echo BASE_URL . '/index.php' ?>" class="logo">
            <h1 class="logo-text"><span>Truman</span> Writes</h1>
        </a>
        <i class="menu-toggle fa fa-bars" id="menu-toggle"></i>
        <ul class="nav" id="nav">
            <li> <a href="<?php echo BASE_URL . '/index.php' ?>">Home</a> </li>
            <li> <a href="<?php echo BASE_URL . '/about.php' ?>">About</a> </li>
            <li> <a href="<?php echo BASE_URL . '/admin/dashboard.php' ?> ">Dashboard</a> </li>
            
            <li> <a href="<?php echo BASE_URL . '/logout.php' ?>">Logout</a> </li>


            <?php if (isset($_SESSION['id'])): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <?php echo $_SESSION['username']; ?>
                    </a>

                </li>

            <?php else: ?>
                <li> <a href="<?php echo BASE_URL . '/register.php' ?>">Sign Up</a> </li>
                <li> <a href="<?php echo BASE_URL . '/login.php' ?>">Login</a> </li>
            <?php endif; ?>


        </ul>
    </header>
