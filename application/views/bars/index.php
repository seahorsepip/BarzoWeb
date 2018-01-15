<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!--
        <div class="row mainDiv">
            <form class="form-inline">
                City: <input type="text" class="form-control" id="filter_city" placeholder="">
            </form>
        </div>-->
    <!--
<div class="row mainDiv">
    <div class="col-md-8 col-md-offset-2">
        <div class="alert alert-warning" id="no_results_error">
        </div>
    </div>
    <?php if (isset($bars) && !empty($bars)) : ?>
        <div id="hideMeBarList">
            <div class="col-md-10 col-md-offset-1" id="bar_list">
                <?php foreach ($bars as $pub_key => $bar): ?>
                    <a href="/"<?php echo $bar['id']; ?>">
                    <div class="row pubRow">
                        <div class="col-md-2 padding-10">
                            <?php if (isset($bar['photos']['profile_image'])) : ?>
                                <img src="<?php echo $bar['photos']['profile_image']; ?>"/>
                            <?php else : ?>
                                <img src="https://res.cloudinary.com/ixbitz/image/upload/v1509307035/placeholder400x400_jwk0g9.png"/>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8 padding-0">
                            <div class="row">
                                <div class="col-md-12 padding-t-10">
                                    <h2><?php echo $bar['name']; ?></h2>
                                </div>
                                <div class="col-md-12">
                                    <?php echo $bar['description']; ?>
                                </div>
                                <div class="col-md-12 padding-t-50">
                                    <h6><?php echo $bar['address'] . " " . $bar['zipcode'] . " " . $bar['city'] ?></h6>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <span class="glyphicon glyphicon-chevron-right pubRowArrow"></span>
                        </div>
                    </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-warning">
                Something went wrong! Please try again later.
            </div>
        </div>
    <?php endif; ?>
    <div class="l-wrapper">
        <svg viewBox="0 0 120 120" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink">

            <symbol id="s--circle">
                <circle r="10" cx="20" cy="20"></circle>
            </symbol>

            <g class="g-circles g-circles--v1">
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
                <g class="g--circle">
                    <use xlink:href="#s--circle" class="u--circle"/>
                </g>
            </g>
        </svg>
    </div>
</div>
</div><!-- / page-content-wrapper -->
    <!-- / content -->
</div><!-- / wrapper -->
<!-- jQuery script -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>
    //Hide loader
    $(function () {
        $(".l-wrapper").hide();
        $("#no_results_error").hide();
    });


    //https://stackoverflow.com/questions/1909441/how-to-delay-the-keyup-handler-until-the-user-stops-typing
    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    function ucFirst(string) {
        return string.charAt(0).toUpperCase() + string.substr(1);
    }

    var searchRequest = null;

    var minlength = 3;


    $("#filter_city").on('input', function () {
        $("#bar_list").fadeOut();
        $("#no_results_error").fadeOut();
        $(".l-wrapper").fadeIn();

        delay(function () {


            var value = ucFirst($("#filter_city").val());

            if (value.length >= minlength) {
                if (searchRequest !== null) {
                    searchRequest.abort();
                }

                //Ajax GET request
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "http://localhost:3000/api/bars?city=" + value,
                    "method": "GET"
                }

                $.ajax(settings).done(function (response) {
                    console.log(response);
                    //Handle loader


                    if ($.isArray(response)) {
                        console.log("IsArray");

                        if ($(response).length > 0) {
                            //At least 1 result
                            $("#bar_list").empty();

                            $.each(response, function (index, item) {
                                $('#bar_list').append('<a href="pubs/' + item['id'] + '"><div class="row pubRow"><div class="col-md-2 padding-10"><img src="' + item['photos']['profile_image'] + '"/></div><div class="col-md-8 padding-0"><div class="row"><div class="col-md-12 padding-t-10"><h2>' + item['name'] + '</h2></div><div class="col-md-12">' + item['description'] + '</div><div class="col-md-12 padding-t-50"><h6>' + item['address'] + ' ' + item['zipcode'] + ' ' + item['city'] + '</h6></div></div></div><div class="col-md-2"><span class="glyphicon glyphicon-chevron-right pubRowArrow"></span></div></div></a>');
                            });

                            $(".l-wrapper").fadeOut(100);
                            $("#bar_list").fadeIn();
                        } else {
                            //Empty result
                            $("#no_results_error").append('<strong>Whoops!</strong> No bars found in ' + value + '!')


                            $(".l-wrapper").fadeOut(100);
                            $("#no_results_error").fadeIn();
                        }
                        //empty bar list
                    }
                });


            } else {
                //Not long enough
                //Get all bars
                var settingsAll = {
                    "async": true,
                    "crossDomain": true,
                    "url": "http://localhost:3000/api/bars",
                    "method": "GET"
                }

                $.ajax(settingsAll).done(function (response) {
                    console.log(response);
                    //Handle loader


                    if ($.isArray(response)) {
                        console.log("IsArray");

                        if ($(response).length > 0) {
                            //At least 1 result
                            $("#bar_list").empty();

                            $.each(response, function (index, item) {
                                $('#bar_list').append('<a href="pubs/' + item['id'] + '"><div class="row pubRow"><div class="col-md-2 padding-10"><img src="' + item['photos']['profile_image'] + '"/></div><div class="col-md-8 padding-0"><div class="row"><div class="col-md-12 padding-t-10"><h2>' + item['name'] + '</h2></div><div class="col-md-12">' + item['description'] + '</div><div class="col-md-12 padding-t-50"><h6>' + item['address'] + ' ' + item['zipcode'] + ' ' + item['city'] + '</h6></div></div></div><div class="col-md-2"><span class="glyphicon glyphicon-chevron-right pubRowArrow"></span></div></div></a>');
                            });

                            $(".l-wrapper").fadeOut(100);
                            $("#bar_list").fadeIn();
                        } else {
                            //Empty result
                            $("#no_results_error").append('<strong>Whoops!</strong> No bars found in ' + value + '!')


                            $(".l-wrapper").fadeOut(100);
                            $("#no_results_error").fadeIn();
                        }
                        //empty bar list
                    }
                });
            }
        }, 1000);
    });
</script>