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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--external css-->
    <!-- Nucleo Icons -->
    <link href="<?php echo base_url(); ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url(); ?>assets/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />

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




<body class="">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
                Psicomob
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?php echo base_url(); ?>/frontend">
                                            <i class="fa fa-chart-pie opacity-6 text me-1"></i>
                                            Home
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="<?php echo base_url(); ?>frontend/search">
                                            <i class="fa fa-user opacity-6 text me-1"></i>
                                            Psicologos
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="<?php echo base_url(); ?>">
                                            <i class="fas fa-user-circle opacity-6 text me-1"></i>
                                            Acessar Sua Conta
                                        </a>
                                    </li>

                                </ul>
                                <ul class="navbar-nav d-lg-block d-none">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>frontend/search" class="btn btn-sm mb-0 me-1 btn-dark">Agendar consulta</a>
                                    </li>
                                </ul>
                            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content  mt-0">
        <div class="page-header position-relative" style="background-image: url('https://demos.creative-tim.com/argon-dashboard-pro/assets/img/pricing-header-bg.jpg');
background-size: cover;">
            <span class="mask bg-gradient-primary opacity-6"></span>
            <div class="container pb-lg-9 pb-10 pt-7 postion-relative z-index-2">
                <div class="row mt-4">
                    <div class="col-md-6 mx-auto text-center">
                        <h3 class="text-white">Encontre seu especialista</h3>
                        <p class="text-white"> Converse com um profissional sem sair de casa
</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-7 mx-auto text-center">
                        <div class="nav-wrapper mt-5 position-relative z-index-2">
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        </div>
    
         <!-- End Navbar -->
    </main>
    <div class="container-fluid py-4">
        <div class="row">
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
                                                    <br><b>R$ <?php echo number_format($doctor->amount_to_pay, '2', ',', '.') ?> / 50 MINUTOS</b>
                                                    <p>


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

                                                <?php
                                                $specialties = explode(",", $doctor->specialties);
                                                foreach ($specialties as $specialtie) {
                                                    echo '<button class="btn btn-outline-secondary" style="margin: 2px"> ' . $specialtie . '</button>';
                                                }

                                                ?>
                                                <p style="margin: 30px;  margin: auto;  text-align: justify;"><?= mb_substr($doctor->profile, 0, 300, 'UTF-8'); ?>

                                    </aside>

                                </div>

                                <div class="col-md-7">

                                    <b>
                                        <h3>Selecione uma data</h3>
                                    </b>
                                    <div class="center slider">
                                        <div>
                                            <button id="" onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+0 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round button-week" value="teste"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('HOJE, %d/%m', strtotime('+0 day', strtotime(date("D-m-y"))))))); ?> </button>

                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+1 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+1 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+2 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+2 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+3 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+3 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+4 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+4 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+5 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+5 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+6 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+6 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+7 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+7 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                        <div>
                                            <button onclick="verificarHoras('<?php echo strftime('%u - %Y-%m-%d', strtotime('+8 day', strtotime(date('D-m-y')))) . ',' . $doctor->id; ?> ')" class="btn btn-info round buttonhours"> <?php echo str_replace(',', '<p>', mb_strtoupper(utf8_encode(strftime('%a, %d/%m', strtotime('+8 day', strtotime(date("D-m-y"))))))); ?> </button>
                                        </div>
                                    </div>
                                    <b>
                                        <h3>Horários disponíveis:</h3>
                                    </b>
                                    <div class="listhours slider" id="<?= $doctor->id ?>" name="listhours">

                                    </div>
                                    <div id="msg<?= $doctor->id ?>">


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
    <script type="text/javascript">
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
            var id = dados['1'];
            var agenda = 'listhours' + id;


            // $(".listhours").slideUp();
            $("#" + id + "").slideUp();
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
                    if (data == "error") {

                        $("#msg" + id + "").html('Nenhum Horário Disponível!');
                        // $(".listhours").slick($opts);
                        //  $(".listhours").slideDown();
                        //   $("#"+id+"").slideDown();




                    } else {
                        // $('.listhours').html = data;
                        $("#" + id + "").slideDown();
                        $("#msg" + id + "").html('');
                        $("#" + id + "").html(data);
                        // document.getElementById(" "+id+" ").innerHTML = data;
                        $(".listhours").slick($opts);




                    }
                }
            })
        }
    </script>