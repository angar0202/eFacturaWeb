<?php
        $url=site_url();        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>E-Tractomaq</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link id="bs-css" href="<?=$url?>css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="<?=$url?>css/charisma-app.css" rel="stylesheet">
    <link href='<?=$url?>bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?=$url?>bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<?=$url?>bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='<?=$url?>bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='<?=$url?>bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='<?=$url?>bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='<?=$url?>css/jquery.noty.css' rel='stylesheet'>
    <link href='<?=$url?>css/noty_theme_default.css' rel='stylesheet'>
    <link href='<?=$url?>css/elfinder.min.css' rel='stylesheet'>
    <link href='<?=$url?>css/elfinder.theme.css' rel='stylesheet'>
    <link href='<?=$url?>css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='<?=$url?>css/uploadify.css' rel='stylesheet'>
    <link href='<?=$url?>css/animate.min.css' rel='stylesheet'>
    <link href='<?=$url?>css/font-awesome/css/font-awesome.css' rel='stylesheet'>
    <link href='<?=$url?>css/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.css">
    
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="<?=$url?>css/bootstrap-datetimepicker.min.css">
</head>

<body style="font-size:12px">
<?=$header?>
<div class="ch-container">
<?=$container?>
<?=$footer?>
</div>



<script src="<?=$url?>bower_components/jquery/jquery.min.js"></script>
<!-- external javascript -->
<script src="<?=$url?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


<!-- library for cookie management -->
<script src="<?=$url?>js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='<?=$url?>bower_components/moment/min/moment.min.js'></script>
<script src='<?=$url?>bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='<?=$url?>js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="<?=$url?>bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?=$url?>bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="<?=$url?>js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="<?=$url?>bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="<?=$url?>bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="<?=$url?>js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?=$url?>js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?=$url?>js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?=$url?>js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?=$url?>js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?=$url?>js/charisma.js"></script>
<script src="<?=$url?>js/tabla.js"></script>
<script src="<?=$url?>js/filtros.js"></script>
<script src="<?=$url?>js/events.js"></script>
<script type="text/javascript" src="<?=$url?>js/bootstrap-datetimepicker.min.js"></script>



<script type="text/javascript">	
  $(function() {
    $('#dtpFechaInicial').datetimepicker({
      pickTime: false,
      format: 'yyyy-MM-dd',
        language: 'es'
    });
    $('#dtpFechaFinal').datetimepicker({
      pickTime: false,
      format: 'yyyy-MM-dd',
        language: 'es'
    });
  });
  $.fn.datetimepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy"
};
</script>

</body>
</html>