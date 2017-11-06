<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!-- content -->
<div id="page-content-wrapper" class="header">
    <div class="container-fluid">
        <div class="row mainDiv">
            <div class="col-md-10 col-md-offset-1">
                <?php foreach ($pubs as $pub_key => $pub): ?>
                        <a href="<?php echo base_url() . "pubs/" . $pub['id']; ?>">
                            <!--Whole row -->
                            <div class="row pubRow">
                                <!-- Main image -->
                                <div class="col-md-2 padding-10">
                                    <?php if(isset($pub['photos']['profile_image'])) : ?>
                                        <img src="<?php echo $pub['photos']['profile_image']; ?>"/>
                                    <?php else : ?>
                                        <img src="https://res.cloudinary.com/ixbitz/image/upload/v1509307035/placeholder400x400_jwk0g9.png"/>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-8 padding-0">
                                    <div class="row">
                                        <!-- Title -->
                                        <div class="col-md-12 padding-t-10">
                                            <h2><?php echo $pub['name']; ?></h2>
                                        </div>
                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <?php echo $pub['description']; ?>
                                        </div>
                                        <!-- Address data -->
                                        <div class="col-md-12 padding-t-50">
                                            <h6><?php echo $pub['location']; ?></h6>

                                        </div>
                                    </div>
                                </div>
                                <!-- This looks like shit, plz fix -->
                                <div class="col-md-2">
                                    <span class="glyphicon glyphicon-chevron-right pubRowArrow"></span>
                                </div>
                            </div>
                        </a>


                <?php endforeach; ?>

            </div>
        </div>
    </div><!-- / page-content-wrapper -->
    <!-- / content -->
</div><!-- / wrapper -->