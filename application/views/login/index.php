<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!-- content -->
<div id="page-content-wrapper" class="header">
    <div class="main container">
        <div class="row loginForm">
            <div class="col-md-6 col-md-offset-3"><h1>Login</h1>
                <?php
                if (isset($warning)) {
                    echo "<div class='alert alert-warning'>";
                    echo $warning;
                    echo "</div>";
                }
                if (isset($error)) {
                    echo "<div class='alert alert-danger'>";
                    echo $error;
                    echo "</div>";
                }
                ?>
                <?php echo form_open('login'); ?>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input class="form-control" id="username" type="username" name="username" value="">
                    </div>
                    <div class="form-group">
                        <label for="pw">Password:</label>
                        <input class="form-control" id="pw" type="password" name="password">
                    </div>
                    <div class="form-group"></div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <br><br><a class="btn btn-info" href="http://maatwerk.works/register">Register</a>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div><!-- / wrapper -->