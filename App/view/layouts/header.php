<?php

use App\core\Auth;
use App\php\URL;

$URI = $_SERVER['REQUEST_URI'];
$Position = strpos("?", $URI);
$URI = $Position === FALSE ? $URI : substr($URI, 0, $Position);
?>

<div class="bs-example">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="<?php echo URL::getURL(); ?>" class="nav-link">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="<?php echo URL::getURL("upload"); ?>">Upload</a>
                </li>

                <?php if (Auth::isUserAdmin()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL::getURL("users"); ?>">Users</a>
                    </li>
                <?php } ?>

                <?php if (Auth::isUserConfirm()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL::getURL("requests"); ?>">Requests</a>
                    </li>
                <?php } ?>
            </ul>

            <?php if (!Auth::checkUser()) { ?>
            <ul class="nav navbar-nav ml-auto">
                <a href="<?php echo URL::getURL("login"); ?>" class="nav-link">Login</a>
            </ul>
            <?php } ?>


            <?php if (Auth::checkUser()) { ?>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <!-- TODO:Username -->
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        Profile
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?php echo URL::getURL("dashboard"); ?>" class="dropdown-item">
                            Dashboard
                        </a>

                        <form action="<?php echo URL::getURL(); ?>" method="POST">
                            <input type="submit" class="dropdown-item" value="Logout"/>
                        </form>
                        <?php } ?>
                    </div>
                </li>
            </ul>
            </ul>
        </div>
    </nav>
</div>