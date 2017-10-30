<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <!-- Page Title -->
            <title>BarZo.</title>
            <!-- Bootstrap CSS -->
            <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
            <!-- CSS -->
            <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
            <!-- Fonts -->
            <link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,400italic,600,700' rel='stylesheet' type='text/css'>
            <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        </head>
        <body>
        <!-- wrapper -->
        <div id="wrapper">
            <!-- side navigation -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                    </li>
                    <?php foreach ($menu as $key => $menu_item):?>
                        <?php if ($key === $controller_origin) : ?>
                            <li class="active">
                                <a class="menu-item" href="<?php echo base_url() . $key;?>"><?php echo $menu_item; ?></a>
                            </li>
                        <?php else : ?>
                            <li>
                                <a class="menu-item" href="<?php echo base_url() . $key;?>"><?php echo $menu_item; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach;?>
                    <li class="menu-footer">
                        <p>© 2016 BarZo.<p>
                    </li>
                </ul>
            </div>
            <!-- / side navigation -->