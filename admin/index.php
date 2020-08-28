<?php include 'inc/config.php'; // Configuration php file ?>
<?php include 'inc/top.php'; // Meta data and header ?>

<!-- Page Content -->
<div id="page-content">
    <!-- Navigation info -->
    <ul id="nav-info" class="clearfix">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li class="active"><a href="">Dashboard</a></li>
    </ul>
    <!-- END Navigation info -->

    <!-- Nav Dash -->
    <ul class="nav-dash">
        <li>
            <a href='#home' data-toggle="tooltip" id="home" title="Главная" class="animation-fadeIn">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <a href='#tracing' data-toggle="tooltip" id="tracing" title="Отслеживание" class="animation-fadeIn">
                <i class="fa fa-bolt"></i>
            </a>
        </li>
        <li>
            <a href='#bets' data-toggle="tooltip" id="bets" title="Ставки" class="animation-fadeIn">
                <i class="fa fa-ticket"></i>
            </a>
        </li>
        <li>
            <a href='#users' data-toggle="tooltip" id="users" title="Пользователи" class="animation-fadeIn">
                <i class="fa fa-user"></i>
            </a>
        </li>
        <li>
            <a href='#calendar' data-toggle="tooltip" id="calendar" title="Календарь" class="animation-fadeIn">
                <i class="fa fa-calendar"></i> <span class="badge badge-inverse">5</span>
            </a>
        </li>
    </ul>
    
    <div class="content"></div>
    
    <style>
        #notifies{
            position:fixed;
            width:auto;
            height:auto;
            top:60px;
            right: 0;
            z-index: 1051;
        }
        
        .alert{
            margin: 5px;
        }
        
        .show{
            opacity: 1;
        }
    </style>
    
    <div id="notifies"></div>
<?   
include 'inc/footer.php'; // Footer and scripts
include 'inc/bottom.php'; // Close body and html tags 
?>
