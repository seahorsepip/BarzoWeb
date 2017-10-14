<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!-- content -->
<div id="page-content-wrapper" class="header">
    <div class="container-fluid">

        <div class="row mainDiv">
            <div class="col-md-10 col-md-offset-1">

                <?php foreach ($pubs as $pub_key => $pub): ?>
                        <!-- TODO: Fix classes and styles here! -->
                        <a href="http://google.com/<?php echo $pub[0]; ?>">
                            <!--Whole row -->
                            <div class="row" style="background-color: #FCFCFC; cursor: pointer; margin-bottom: 20px; border-radius: 10px; color: #080808;">
                                <!-- Main image -->
                                <div class="col-md-2" style="padding: 10px;">
                                    <img src="http://via.placeholder.com/250x250" style="float:left; border-radius: 10px;" width="150" height="150"/>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <!-- Title -->
                                        <div class="col-md-12" style="padding-top: 10px">
                                            <h2><?php echo $pub[0]; ?></h2>
                                        </div>
                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <?php echo $pub[1]; ?>
                                        </div>
                                        <!-- Address data -->
                                        <div class="col-md-12" style="padding-top: 50px;">
                                            <h6 style="margin: 0;"><?php echo $pub[2]; ?></h6>
                                            <h6 style="margin: 0;"><?php echo $pub[3]; ?></h6>
                                            <h6 style="margin: 0;"><?php echo $pub[4]; ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- This looks like shit, plz fix -->
                                <div class="col-md-2">
                                    <span class="glyphicon glyphicon-chevron-right" style="font-size: 50px; float: right;"></span>
                                </div>
                            </div>
                        </a>


                <?php endforeach; ?>

            </div>
        </div>
    </div><!-- / page-content-wrapper -->
    <!-- / content -->
</div><!-- / wrapper -->