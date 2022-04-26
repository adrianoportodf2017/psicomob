<!DOCTYPE html>
<html lang="en">
<base href="<?php echo base_url(); ?>">
<?php
$settings = $this->frontend_model->getSettings();
$title = explode(' ', $settings->title);
$site_name = $this->db->get('website_settings')->row()->title;

 ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../../../favicon.ico" />
    <title><?php echo $site_name; ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" />
    <!-- Font-awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- jQuery Plugins -->
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('front/site_assets/vendor/magnific-popup/magnific-popup.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('common/assets/bootstrap-timepicker/compiled/timepicker.css'); ?>">
    <!--<link rel="stylesheet" href="<?php echo site_url('front/css/style.css'); ?>">-->
    <link rel="stylesheet" href="<?php echo site_url('front/css/responsive.css'); ?>">

    <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/css/rs-style.css'); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo site_url('front/assets/revolution_slider/rs-plugin/css/settings.css'); ?>" media="screen">
    <!-- CSS Stylesheet -->
    <link href="<?php echo site_url('front/site_assets/css/style.css'); ?>" rel="stylesheet" />
    <link href="<?php echo site_url('front/site_assets/css/responsive.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.css'); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>app-assets/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>app-assets/slick/slick-theme.css">
</head>
<style>
    .topbar-texts,
    .footer-description {
        font-family: "Roboto", sans-serif !important;
        font-size: 15px !important;
    }

    body {
        background-color: #f9f9fa
    }

    .padding {
        padding: 3rem !important
    }

    .user-card-full {
        overflow: hidden
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        border: none;
        margin-bottom: 30px
    }

    .m-r-0 {
        margin-right: 0px
    }

    .m-l-0 {
        margin-left: 0px
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px
    }

    .bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
        background: linear-gradient(to right, #ee5a6f, #f29263)
    }

    .user-profile {
        padding: 20px 0
    }

    .card-block {
        padding: 1.25rem
    }

    .m-b-25 {
        margin-bottom: 25px
    }

    .img-radius {
        border-radius: 5px
    }

    h6 {
        font-size: 14px
    }

    .card .card-block p {
        line-height: 25px
    }

    @media only screen and (min-width: 1400px) {
        p {
            font-size: 14px
        }
    }

    .card-block {
        padding: 1.25rem
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .card .card-block p {
        line-height: 25px
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .text-muted {
        color: #919aa3 !important
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .f-w-600 {
        font-weight: 600
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .user-card-full .social-link li {
        display: inline-block
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out
    }
</style>

<!-- BEGIN: Main Menu-->
<style>
    .slider {

        width: 95%;
        margin: 30px auto;
        min-width: 100px;
    }

    .slick-slide {
        margin: 0px 0px;
    }

    .slick-slide img {
        width: 95%;
    }

    .slick-next,
    .slick-arrow {
        height: 50px;


    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
    }


    .slick-slide {
        transition: all ease-in-out .2s;

    }

    .slick-active {}

    .slick-current {}

    .box {

        min-width: 100px;
        height: 300px;


    }

    .scrolling-wrapper {


        display: flex;
        flex-wrap: nowrap;

    }



    .hours {
        width: 100%;
        height: 400px;
        border: 1px solid black;
    }

    .buttonhours {
        height: 50px;
        position: relative;
        margin: 5px;
        margin-left: 10px;
        width: 97%;
        border-style: 5px solid red;

    }

    .button-week {
        position: relative;
        margin-bottom: 2px;
        margin-left: 10px;

        text-align: center;
        font-weight: bold;
        font-size: 1.1rem;
        color: white;
        height: 65px;
        width: 90%;

    }
</style>

<body onload="">


    <!---------------- Start Main Navbar ---------------->
    <div id="header_menu_top" class="bg-dark text-white pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="topbar-texts"><?php echo $settings->address; ?></p>
                </div>
                <div class="col-md-4">
                    <p class="topbar-texts float-right ml-3">
                        <i class="fa fa-phone" aria-hidden="true"></i> &nbsp;
                        <span><?php echo $settings->phone; ?></span>
                    </p>
                </div>
                <div class="col-md-2">
                    <a href="<?php echo site_url('auth/login') ?>" class="float-right"><i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp; <span>Sign In</span></a>
                </div>
            </div>
        </div>
    </div>
    <div id="header">
        <div class="navbar-wrap">
            <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="frontend#">
                        <?php
                        if (!empty($settings->logo)) {
                            if (file_exists($settings->logo)) {
                                echo '<img width="200" src=' . $settings->logo . '>';
                            } else {
                                echo $title[0] . '<span> ' . $title[1] . '</span>';
                            }
                        } else {
                            echo $title[0] . '<span> ' . $title[1] . '</span>';
                        }
                        ?>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="frontend#"><?php echo lang('home'); ?></a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="frontend#why_choose_us"><?php echo lang('book_an_appointment'); ?></a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="frontend#featured_services"><?php echo lang('services'); ?></a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="frontend#doctor"><?php echo lang('doctors'); ?></a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="frontend#portfolio"><?php echo lang('portfolio'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row ">
            <div class="col-2"></div>
            <div class="col-xl-8" style="margin: 10px;">
                <?php

                foreach ($doctors as $doctor) { ?>

                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body ">
                            <div class="row " style=" margin: auto;   text-align: center;">
                                <div class="col-md-5 ">
                                    <aside class="profile-nav ">
                                        <div class="user-heading round">
                                            <div class="row">
                                            <div class="col-5">
                                                    <?php if (!empty($doctor->img_url)) { ?>
                                                        <a href="#">
                                                            <div class="m-b-25"> <img src="<?= $doctor->img_url ?>" class="img-radius" alt="User-Profile-Image" style="max-width: 200px; width: 150px; border-radius: 50%;"> </div>
                                                        </a>
                                                    <?php } ?>
                                                    <br><b>R$ <?php echo number_format($doctor->amount_to_pay, '2', ',', '.') ?> / 50 MINUTOS</b><p>

                                                    
                                                </div>
                                                <div class="col-6">
                                                    <h5><?php echo $doctor->name ?>
                                                        </b></h5>
                                                        <h6 class="text-dark"><b>CRP: | </b><b class="text-bold-700"> <?= $doctor->crp ?></b></h6>
                                                        <span>(10 Avaliações)<br>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        <br>
                                                            8 Sessões realizadas

                                                </div>
                                              
                                            </div>
                                            <div class="card-block">
                                                <div class="row">
                                                 
                                                         <?php
                                                            $specialties = explode(",", $doctor->specialties);
                                                            foreach ($specialties as $specialtie) {
                                                                echo '<button class="btn btn-outline-secondary" style="margin: 2px"> ' . $specialtie . '</button>';
                                                            }

                                                            ?>
                                                        <p  style="margin: 30px;  margin: auto;  text-align: justify;"><?= mb_substr($doctor->profile, 0, 300, 'UTF-8'); ?>
                                                </div>
                                    </aside>

                                </div>

                                <div class="col-md-7">

                                    <b>
                                        <h3>Selecione uma data</h3>
                                    </b>
                                    <div class="center slider">
                                        <div>
                                            <button id=""  onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+0 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round button-week" value="teste"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('HOJE, %d/%m', strtotime('+0 day', strtotime(date("D-m-y"))))))); ?> </button>

                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+1 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+1 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+2 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+2 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+3 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+3 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+4 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+4 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+5 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+5 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+6 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+6 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+7 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+7 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+8 day', strtotime(date('D-m-y')))).','.$doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+8 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                    </div>
                                    <b>
                                        <h3>Horários disponíveis:</h3>
                                    </b>
                                    <div class="listhours slider" id="<?= $doctor->id?>" name="listhours">

                                    </div>
                                    <div id="msg<?= $doctor->id?>">


                                    </div>
                                    <button style="max-width: 250px;" class="btn btn btn-outline-success round buttonhours"> Agendar uma Consulta Online</button>

                                </div>
                                <button style="max-width: 250px; margin: 30px;  text-align: center;" class="btn btn btn-outline-primary round buttonhours"> Ver Perfil</button>

                            </div>


                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>


    </section>


    <!---------------- End Testimonials Slider Area ---------------->

    <!---------------- Start Footer Area ---------------->
    <div id="footer" class="text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <img src="<?php echo $settings->logo; ?>" class="img-fluid">

                </div>
                <div class="col-md-3 mb-3">
                    <h6 class="my-2"><?php echo lang('about_us'); ?></h6>
                    <p class="footer-description">
                        <?php echo $settings->description; ?>
                    </p>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="social-media text-center">
                        <h6 class="my-2"><?php echo lang('STAY_CONNECTED'); ?></h6>
                        <div class="social-icon">

                            <?php if (!empty($settings->facebook_id)) { ?>
                                <a href="<?php echo $settings->facebook_id; ?>">
                                    <div class=""><i class="fa fa-facebook"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->google_id)) { ?>
                                <a href="<?php echo $settings->google_id; ?>">
                                    <div><i class="fa fa-google-plus"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->twitter_id)) { ?>
                                <a href="<?php echo $settings->twitter_id; ?>">
                                    <div><i class="fa fa-twitter"></i></div>
                                </a> <?php } ?>
                            <?php if (!empty($settings->youtube_id)) { ?>
                                <a href="<?php echo $settings->youtube_id; ?>">
                                    <div><i class="fa fa-youtube"></i></div>
                                </a> <?php } ?>

                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="my-2"><?php echo lang('CONTACT_INFO'); ?></h6>
                    <address>
                        <strong><?php echo lang('address'); ?>: <?php echo $settings->address; ?></strong><br />
                        <strong><?php echo lang('phone'); ?>: <?php echo $settings->phone; ?></strong><br />
                        <strong><?php echo lang('email'); ?>: <?php echo $settings->email; ?></strong>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript  -->
    <script src="<?php echo site_url('front/site_assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/jquery/popper.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/owl-carousel/owl.carousel.min.js'); ?>"></script>
    <script src="<?php echo site_url('front/site_assets/vendor/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- JS Main File -->
    <script src="<?php echo site_url('front/site_assets/js/main.js'); ?>"></script>
    <script src="<?php echo site_url('common/toastr/toastr.js'); ?>"></script>
    <!-- <link rel="stylesheet" href="<?php echo site_url('common/toastr/toastr.js'); ?>" />-->
    <!--<script src="front/js/jquery.js"></script>-->
    <script src="front/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo site_url('front/js/wow/wow.min.js'); ?>"></script>
    <script src="front/js/smoothscroll/jquery.smoothscroll.min.js"></script>
    <script src="<?php echo site_url('front/js/script.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>
    <script src="<?php echo site_url('front/assets/fancybox/source/jquery.fancybox.pack.js'); ?>"></script>

    <!--<script type="text/javascript" src="<?php echo site_url('front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js'); ?>"></script>
                    <script type="text/javascript" src="<?php echo site_url('front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>"></script>
                    <script src="front/js/revulation-slide.js"></script>-->
        <script type = "text/javascript" >
            $(document).ready(function() {
                $(function() {
                    $('.icon-picker').iconpicker();
                });
            });
    </script>

    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).on('ready', function() {

            $(".center").slick({
                dots: false,
                infinite: false,
                centerMode: false,
                slidesToShow: 3,
                slidesToScroll: 2
            });

            $(".lazy").slick({
                lazyLoad: 'ondemand', // ondemand progressive anticipated
                infinite: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".listhours").slick({
                dots: false,
                infinite: false,
                centerMode: false,
                slidesToShow: 3,
                slidesToScroll: 2
            });
        });


        function verificarHoras(dados) {
            var $opts = {
                dots: false,
                infinite: false,
                centerMode: false,
                slidesToShow: 3,
                slidesToScroll: 2
            }
            dados = dados.split(",")
            var start = dados['0'];
            var id =  dados['1'];
            var agenda = 'listhours'+id;
          
          
           // $(".listhours").slideUp();
            $("#"+id+"").slideUp();
            $(".listhours").slideUp();
            $(".listhours").slick('unslick');
           

          

            $.ajax({
                url: "<?php echo base_url(); ?>frontend/list_hour_doctor",
                type: "POST",
                data: {
                    start: start,
                    id: id
                },
                success: function(data) {
                    if(data == "error"){

                        $("#msg"+id+"").html('Nenhum Horário Disponível!');                      
                       // $(".listhours").slick($opts);
                      //  $(".listhours").slideDown();
                     //   $("#"+id+"").slideDown();

                        
                        

                    }
                    else{
                   // $('.listhours').html = data;
                   $("#"+id+"").slideDown();
                   $("#msg"+id+"").html(''); 
                   $("#"+id+"").html(data);
                   // document.getElementById(" "+id+" ").innerHTML = data;
                   $(".listhours").slick($opts); 
            
                  


                }}
            })
        }
    </script>