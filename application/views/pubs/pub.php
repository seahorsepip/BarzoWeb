<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!-- content -->
<div id="page-content-wrapper" class="header">
    <div class="container-fluid">

        <div class="row mainDiv">
            <div class="col-md-10 col-md-offset-1" style="background-color: #ffffff; border-radius: 10px;">

                <div class="row">
                    <div class="col-md-4" style="padding: 10px;">
                        <img src="http://via.placeholder.com/400x400" style="float:left; border-radius: 10px;"/>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 30px;">
                                <h1><?php echo $pub[1]; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 10px;">
                                <h4><?php echo $pub[2]; ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 50px;">
                                <?php echo nl2br($pub[3] . "\n" . $pub[4] . " " . $pub[5]); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- / page-content-wrapper -->
    <!-- / content -->
</div><!-- / wrapper -->