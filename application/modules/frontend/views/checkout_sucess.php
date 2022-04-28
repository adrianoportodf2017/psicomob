<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from demo.createx.studio/mstore/checkout-payment.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jul 2020 14:56:08 GMT -->
    <head>
        <meta charset="utf-8">
        <title>Pedido Finalizado | Academy
        </title>
        <!-- SEO Meta Tags-->
        <meta name="description" content="MStore - Modern Bootstrap E-commerce Template">
        <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
        <meta name="author" content="Createx Studio">
        <!-- Viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon and Touch Icons-->
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        <link rel="mask-icon" color="#111" href="safari-pinned-tab.svg">
        <meta name="msapplication-TileColor" content="#111">
        <meta name="theme-color" content="#ffffff">
        <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
        <link rel="stylesheet" media="screen" href="<?= base_url() ?>assets/payment/css/vendor.min.css">
        <!-- Main Theme Styles + Bootstrap-->
        <link rel="stylesheet" media="screen" id="main-styles" href="<?= base_url() ?>assets/payment/css/theme.min.css">
        <!-- Customizer styles and scripts-->
        <link rel="stylesheet" media="screen" href="<?= base_url() ?>assets/payment/customizer/customizer.min.css">
        <!-- Google Tag Manager-->
       
    </head>
    <!-- Body-->
    <body>
        <?php
        $usuario = $this->user_model->get_all_user($user_id)->row_array();
        $cpf = $this->payment_model->soNumero($usuario['cpf']);
        $email = $usuario['email'];
        ?>
        <!-- Page Title-->
        <div class="page-title-wrapper" aria-label="Page title">
            <div class="container">
                <nav aria-label="breadcrumb">

                </nav>
                <h1 class="page-title"><</h1><span class="d-block mt-2 text-muted"></span>
            </div>
        </div>
        <!-- Page Content-->
        <div class="container pb-5 mb-sm-4">
            <div class="pt-5">
                <div class="card py-3 mt-sm-3">
                    <div class="card-body text-center">
                        <div id="dados" data-cpf="<?= $cpf ?>" data-email="<?= $email ?>"></div>
                        <h3 class="h4 pb-3">Seu agendamento foi concluída com sucesso!</h3>
                        <p class="mb-2">Você receberá a confirmação pelo email.</p>
                        <p class="mb-2"></p>
                        <p>Caso este seja o seu primeiro acesso, você poderá efetuar o Login utilizando seu e-mail e CPF como senha.</p>
                        <p>  <?php echo 'Link: '. base_url() . 'auth/login'; ?>
                        <a class="btn btn-primary mt-3" href="<?php echo base_url() . 'auth/login'; ?>" ><i data-feather="map-pin"></i>&nbsp;Login</a>
                    </div>
                </div>
            </div>
            <br> <br> <br> <br> <br>
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
    


    <!-- Footer-->
    <footer class="page-footer bg-dark divPedido">

        <div class="py-3" style="background-color: #1a1a1a;">
        </div>
    </footer>
    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script src="<?= base_url() ?>assets/payment/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/card.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/theme.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/jquery.3.5.3.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/jquery.mask.js"></script>
    <!--<script src="<?= base_url() ?>assets/payment/js/busca_cep.js"></script>-->
    <script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <!--<script src="<?= base_url() ?>assets/payment/js/custom.js"></script>-->
    <script src="<?= base_url() ?>assets/payment/customizer/customizer.min.js"></script>
    <script src="<?= base_url() . 'assets/global/toastr/toastr.min.js'; ?>"></script>
    <script src="<?= base_url() ?>assets/payment/js/sweetalert.min.js"></script>
