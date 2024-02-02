    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= APPURL; ?>">LOGO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav side-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" style="margin-left: 20px;" href="<?= APPURL; ?>">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= APPURL; ?>admins/admins.php" style="margin-left: 20px;">Admins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= APPURL; ?>categories-admins/show-categories.php"
                            style="margin-left: 20px;">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= APPURL; ?>products-admins/show-products.php"
                            style="margin-left: 20px;">Products</a>
                    </li>

                </ul>
                <ul class="navbar-nav ml-md-auto d-md-flex">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= APPURL; ?>index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php if (!isset($_SESSION['admin_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= APPURL; ?>admins/login-admins.php">login
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= APPURL; ?>#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['username']; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= APPURL; ?>admins/admin-logout.php">Logout</a>

                        </li>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </nav>