<script src="<?= base_url() ?>assets/payment/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/card.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/theme.min.js"></script>
    <script src="<?= base_url() ?>assets/payment/js/jquery.mask.js"></script>
    <!--<script src="<?= base_url() ?>assets/payment/js/busca_cep.js"></script>-->
    <script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <!--<script src="<?= base_url() ?>assets/payment/js/custom.js"></script>-->
    <script src="<?= base_url() ?>assets/payment/js/sweetalert.min.js"></script>

<!--   Core JS Files   -->
<script src="<?php echo base_url(); ?>assets/js/core/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
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
<script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>"></script>

<!--<script type="text/javascript" src="<?php echo site_url('front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js'); ?>"></script>
                    <script type="text/javascript" src="<?php echo site_url('front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>"></script>
                    <script src="front/js/revulation-slide.js"></script>-->

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<!--footer end-->
</section>


<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>common/js/jquery.js"></script>

<script src="<?php echo base_url(); ?>common/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>common/js/jquery.scrollTo.min.js"></script>

<script src="<?php echo base_url(); ?>common/js/moment.min.js"></script>

<!--
<script src="<?php echo base_url(); ?>common/js/jquery.nicescroll.js" type="text/javascript"></script>
-->

<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>common/js/respond.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>common/js/jquery.cookie.js"></script>
<!--<?php echo base_url(); ?>common script for all pages-->
<script src="<?php echo base_url(); ?>common/js/lightbox.js"></script>
<!--script for this page only-->


<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<!--script da agenda slide-->
<script src="<?php echo base_url('app-assets/slick/slick.js') ?>" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" ></script>



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


<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>


<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
</body>

</html>


<?php
$language = $this->db->get('settings')->row()->language;

if ($language == 'english') {
    $lang = 'en';
    $langdate = 'en-CA';
} elseif ($language == 'spanish') {
    $lang = 'es';
    $langdate = 'es';
} elseif ($language == 'french') {
    $lang = 'fr';
    $langdate = 'fr';
} elseif ($language == 'portuguese') {
    $lang = 'pt';
    $langdate = 'pt';
} elseif ($language == 'arabic') {
    $lang = 'ar';
    $langdate = 'ar';
} elseif ($language == 'italian') {
    $lang = 'it';
    $langdate = 'it';
} elseif ($language == 'zh_cn') {
    $lang = 'zh-cn';
    $langdate = 'zh-CN';
} elseif ($language == 'japanese') {
    $lang = 'ja';
    $langdate = 'ja';
} elseif ($language == 'russian') {
    $lang = 'ru';
    $langdate = 'ru';
} elseif ($language == 'turkish') {
    $lang = 'tr';
    $langdate = 'tr';
} elseif ($language == 'indonesian') {
    $lang = 'id';
    $langdate = 'id';
}
?>




<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/bootstrap-datepicker/locales/bootstrap-datepicker.<?php echo $langdate; ?>.min.js"></script>

<script src="<?php echo base_url(); ?>common/assets/DataTables/DataTables-1.10.16/custom/js/datatable-responsive-cdn-version-2-2-5.js"></script>



<script>
    $('.multi-select').multiSelect({
        selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=' search...'>",
        selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=''>",
        afterInit: function(ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function() {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function() {
            this.qs1.cache();
            this.qs2.cache();
        }
    });
</script>

<script>
    $('#my_multi_select3').multiSelect()
</script>

<script>
    $('.default-date-picker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: '01-01-1900',
        clearBtn: true,
        language: '<?php echo $langdate; ?>'
    });


    $('#date').on('changeDate', function() {
        $('#date').datepicker('hide', {
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '01-01-1900',
            language: '<?php echo $langdate; ?>'
        });
    });

    $('#date1').on('changeDate', function() {
        $('#date1').datepicker('hide', {
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '01-01-1900',
            language: '<?php echo $langdate; ?>'
        });
    });
</script>







<script>
    $(document).ready(function() {
        $('.timepicker-default').timepicker({
            defaultTime: 'value'
        });

    });
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>common/assets/select2/js/select2.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $(".js-example-basic-single").select2();

        $(".js-example-basic-multiple").select2();
    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        var windowH = $(window).height();
        var wrapperH = $('#container').height();
        if (windowH > wrapperH) {
            $('#sidebar').css('height', (windowH) + 'px');
        } else {
            $('#sidebar').css('height', (wrapperH) + 'px');
        }
        var windowSize = window.innerWidth;
        if (windowSize < 768) {
            $('#sidebar').removeAttr('style');
        }
    });

    function onElementHeightChange(elm, callback) {
        var lastHeight = elm.clientHeight,
            newHeight;
        (function run() {
            newHeight = elm.clientHeight;
            if (lastHeight != newHeight)
                callback();
            lastHeight = newHeight;
            if (elm.onElementHeightChangeTimer)
                clearTimeout(elm.onElementHeightChangeTimer);
            elm.onElementHeightChangeTimer = setTimeout(run, 200);
        })();
    }




    onElementHeightChange(document.body, function() {
        var windowH = $(window).height();
        var wrapperH = $('#container').height();
        if (windowH > wrapperH) {
            $('#sidebar').css('height', (windowH) + 'px');
        } else {
            $('#sidebar').css('height', (wrapperH) + 'px');
        }

        var windowSize = $(window).width();
        if (windowSize < 768) {
            $('#sidebar').removeAttr('style');
        }
    });







    $(window).resize(function() {

        if (width == GetWidth()) {
            return;
        }

        width = GetWidth();

        if (width < 600) {
            $('#sidebar').hide();
        } else {
            $('#sidebar').show();
        }

    });
</script>
<script>
    $(document).ready(function() {
        //   $('#')
    });
</script>

</script>
  <script>

$(document).ready(function(){
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('(00) 00000-0000');
    $('.cpf').mask('000.000.000-00');
    $('.money').mask('000.000.000.000,00');
});</script>











