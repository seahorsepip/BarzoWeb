<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!-- content -->
<div id="page-content-wrapper" class="header">
    <div class="container-fluid">

        <div class="row mainDiv">
            <?php if(isset($pub) && !empty($pub)) : ?>
            <div class="col-md-10 col-md-offset-1 profileBg">
                <div class="row">
                    <div class="col-md-5 padding-10">
                        <?php if(isset($pub['photos']['profile_image'])) : ?>
                            <img src="<?php echo $pub['photos']['profile_image']; ?>" class="profilePic"/>
                        <?php else : ?>
                            <img src="https://res.cloudinary.com/ixbitz/image/upload/v1509307035/placeholder400x400_jwk0g9.png" class="profilePic"/>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 padding-t-30">
                                <h1><?php echo $pub['name']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 padding-t-30">
                                <h4><?php echo $pub['description']; ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 padding-t-50">
                                <?php echo $pub['address'] . " " . $pub['zipcode'] . " " . ucfirst($pub['city']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <h3 class="margin-10">Impressions</h3>
                    <!-- All images -->
                    <?php if(isset($pub['photos']['images'])) : ?>
                        <?php foreach ($pub['photos']['images'] as $image) : ?>
                            <a href="<?php echo $image; ?>" target="_blank"><img src="<?php echo $image; ?>" class="profileImg margin-10"/></a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <a href="https://res.cloudinary.com/ixbitz/image/upload/v1509307035/placeholder400x400_jwk0g9.png"><img src="https://res.cloudinary.com/ixbitz/image/upload/v1509307035/placeholder400x400_jwk0g9.png" class="profileImg margin-10"/></a>
                    <?php endif; ?>
                </div>

            </div>
            <?php else : ?>
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-warning" id="no_results_error">
                    Something went wrong! Please try again later.
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div><!-- / page-content-wrapper -->
    <!-- / content -->
</div><!-- / wrapper -->