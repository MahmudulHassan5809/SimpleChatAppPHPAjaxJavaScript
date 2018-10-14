<?php
    if (isset($_GET['action']) && $_GET['action']=="logout" ) {
      $userLogOut = $user->logOut();
      Session::destroy();
    }
?>
<div class="col-md-4">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Chat APplication
                    </a>
                </li>
                <li>
                    <a href="change_password.php">Change Password</a>
                </li>

                <li>
                    <a href="#">Online User <span class="online"></span></a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="?action=logout">Lgout</a>
                </li>
            </ul>

</div>
