    <header>
        <a href="<?php echo BASE_URL . '/index.php'; ?>" class="logo">
            <h1 class="logo-text"><span>Truman</span> Writes</h1>
        </a>
        <i class="menu-toggle fa fa-bars" id="menu-toggle"></i>
        <ul class="nav" id="nav">
            <?php if (isset($_SESSION['username'])) : ?>                
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                </a>
            </li>
            <li><a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout">Logout</a></li>
        <?php endif; ?> 
        </ul>
    </header>