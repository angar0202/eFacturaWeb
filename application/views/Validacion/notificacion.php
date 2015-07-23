<?php
        $url=site_url();        
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta Facturación Eléctronica</title>
    <!-- Bootstrap -->
    <link href="<?=$url?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$url?>css/styles.css" rel="stylesheet">
    <style>
  #mensaje{
    background: <?=$color?>;
    margin: 3px;
    display: none;
    float: left;
  }
  </style>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

<div class="container">
       <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div id="mensaje" class="panel panel-default">
                <div class="panel-body">
                  <div><?=$mensaje?></div> 
                </div>
              </div>
            </div>
        </div>
</div>

  <script>
  $(function() {
    if ( $( "#mensaje" ).is( ":hidden" ) ) {
      $( "#mensaje" ).slideDown( "slow" );
    } else {
      $( "#mensaje" ).hide();
    }
  });
  var myVar=setInterval(function () {redirect()}, 4000);
  function redirect() {
      window.location.replace("<?=$url?>");
  }
  </script>
  </body>
  </html>