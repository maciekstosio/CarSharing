<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' type='text/css' href="<?php echo base_url("css/jquery-ui-1.8.11.custom.css"); ?>" />
    <link rel='stylesheet' type='text/css' href="<?php echo base_url("css/jquery.weekcalendar.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('css/uikit.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('css/app.css'); ?>" />
    <script src="<?php echo base_url('js/uikit.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/uikit-icons.min.js'); ?>"></script>
    <title>CarSharing</title>
</head>
<body>

    <nav class="uk-navbar-container uk-margin" uk-navbar="mode: click">
        <div class="uk-navbar-left">
    
            <ul class="uk-navbar-nav">
                <a class="uk-navbar-item uk-logo" href="<?php echo site_url(); ?>">CarSharing</a>
            </ul>
    
        </div>

        <div class="uk-navbar-right">

            <ul class="uk-navbar-nav">
                <?php if(logged_id()): ?>
                    <li>
                        <a href="#"><?php echo logged_name(); ?></a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="#">Settings</a></li>
                                <li><a href="<?php echo site_url('user/logout'); ?>">Log out</a></li>
                            </ul>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo site_url('user'); ?>">Log in</a></li>
                    <li><a href="<?php echo site_url('user/join'); ?>">Sign Up</a></li>
                <?php endif; ?>
            </ul>
    
        </div>
    
    </nav>

    <?php if (isset_alert()): ?>
    <div class="uk-alert-<?php echo get_alert_type(); ?>" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><?php echo get_alert_message(); ?></p>
    </div>
    <?php endif; ?>

    <?php if(logged_id()) : ?>
    <div class="uk-grid-small" id="container" uk-grid>
        <div class="uk-width-1-6">      
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <li class="uk-active"><a href="<?php echo site_url(); ?>"><span class="uk-margin-small-right" uk-icon="icon: home"></span> Dashboard</a></li>
                <li><a href="<?php echo site_url("car/add"); ?>"><span class="uk-margin-small-right" uk-icon="icon: plus"></span> Add car</a></li>
                <li><a href="<?php echo site_url("planer/my_planer"); ?>"><span class="uk-margin-small-right" uk-icon="icon: future"></span> Create plan</a></li>
                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: social"></span> Matcher</a></li>
            </ul>
        </div>
        <div class="uk-width-5-6">

    <?php endif; ?>