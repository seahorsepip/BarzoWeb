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
                        <!-- TODO: Fix aspect ratio in images -->
                        <?php if(isset($pub['photos']['profile_image'])) : ?>
                            <img src="<?php echo $pub['photos']['profile_image']; ?>" style="float:left; border-radius: 10px;" width="400"/>
                        <?php else : ?>
                            <img src="https://res.cloudinary.com/ixbitz/image/upload/v1509307035/placeholder400x400_jwk0g9.png" style="float:left; border-radius: 10px;" width="400"/>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 30px;">
                                <h1><?php echo $pub['name']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 10px;">
                                <h4><?php echo $pub['description']; ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 50px;">
                                <?php echo $pub['location']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <h3 style="margin-left: 10px;">Impressions</h3>
                    <!-- All images -->
                    <?php if(isset($pub['photos']['images'])) : ?>
                        <?php foreach ($pub['photos']['images'] as $image) : ?>
                            <a href="<?php echo $image; ?>" target="_blank"><img src="<?php echo $image; ?>" style="float:left; border-radius: 10px; margin:10px;" height="150"/></a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <a href="https://res.cloudinary.com/ixbitz/image/upload/v1509307035/placeholder400x400_jwk0g9.png"><img src="https://res.cloudinary.com/ixbitz/image/upload/v1509307035/placeholder400x400_jwk0g9.png" style="float:left; border-radius: 10px; margin:10px;" height="150"/></a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div><!-- / page-content-wrapper -->
    <!-- / content -->
</div><!-- / wrapper -->