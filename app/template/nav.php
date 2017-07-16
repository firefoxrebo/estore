<nav class="main_navigation <?= (isset($_COOKIE['menu_opened']) && $_COOKIE['menu_opened'] == 'true') ? 'opened no_animation' : '' ?>">
    <div class="employee_info">
        <div class="profile_picture">
            <img src="/img/user.png" alt="User Profile Picture">
        </div>
        <span class="name">محمد يحيى</span>
        <span class="privilege"><?= $text_app_manager ?></span>
    </div>
    <ul class="app_navigation">
        <li><a href="/"><i class="fa fa-dashboard"></i> <?= $text_general_statistics ?></a></li>
        <li><a href="/transactions"><i class="fa fa-credit-card"></i> <?= $text_transactions ?></a></li>
        <li><a href="/expenses"><i class="fa fa-money"></i> <?= $text_expenses ?></a></li>
        <li><a href="/store"><i class="material-icons">store</i> <?= $text_store ?></a></li>
        <li><a href="/clients"><i class="material-icons">contacts</i> <?= $text_clients ?></a></li>
        <li><a href="/suppliers"><i class="material-icons">group</i> <?= $text_suppliers ?></a></li>
        <li><a href="/users"><i class="fa fa-group"></i> <?= $text_users ?></a></li>
        <li><a href="/reports"><i class="fa fa-bar-chart"></i> <?= $text_reports ?></a></li>
        <li><a href="/notifications"><i class="fa fa-bell"></i> <?= $text_notifications ?></a></li>
        <li><a href="/auth/logout"><i class="fa fa-sign-out"></i> <?= $text_log_out ?></a></li>
    </ul>
</nav>
<div class="action_view <?= (isset($_COOKIE['menu_opened']) && $_COOKIE['menu_opened'] == 'true') ? 'collapsed no_animation' : '' ?>">
<?php if(isset($_SESSION['message'])) { ?>
<p class="message <?= isset($error) ? 'error' : '' ?>"><?= $_SESSION['message'] ?></p>
<?php unset($_SESSION['message']); } ?>