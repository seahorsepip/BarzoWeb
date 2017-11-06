<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!-- content -->
<div id="page-content-wrapper" class="header">
    <div class="container-fluid">

        <div class="row mainDiv">
            <div class="col-md-10 col-md-offset-1 profileBg">
                <?php
                if (isset($warning)) {
                    echo "<div class='alert alert-warning'>";
                    echo $warning;
                    echo "</div>";
                }
                if (isset($error)) {
                    echo "<div class='alert alert-danger'>";
                    //echo $error;
                    echo "<pre>" . print_r($error) . "</pre>";
                    echo "</div>";
                }
                ?>
                <?php echo form_open_multipart('pubs/create'); ?>
                    <div class="form-group">
                        <label for="bar_name">Bar Name:</label>
                        <input class="form-control" id="bar_name" type="text" name="bar_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="bar_description">Bar Description:</label>
                        <textarea rows="5" cols="50" class="form-control" name="bar_description" id="bar_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bar_address">Street + number:</label>
                        <input class="form-control" id="bar_address" type="text" name="bar_address" value="">
                    </div>
                    <div class="form-group"
                        <label for="bar_zipcode">Zipcode:</label>
                        <input class="form-control" id="bar_zipcode" type="text" name="bar_zipcode" value="">
                    </div>
                    <div class="form-group">
                        <label for="bar_city">City:</label>
                        <input class="form-control" id="bar_city" type="text" name="bar_city" value="">
                    </div>
                    <div class="form-group">
                        <label for="bar_profileimage">Main profile image:</label>
                        <input class="form-control" id="bar_profileimage" type="file" name="bar_profileimage">
                    </div>
                    <div class="form-group">
                        <label for="bar_images">Impression images:</label>
                        <input class="form-control" id="bar_images" type="file" name="bar_images[]" multiple>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>

    </div><!-- / page-content-wrapper -->
    <!-- / content -->
</div><!-- / wrapper -->