<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Votos - Urian Viera</title>
    <link rel="icon" href="img/logo-mywebsite-urian-viera.svg">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/pricing/">

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script type="text/javascript">
$(function(){
 $("#botonenviar").click(function(){
 var url = "voto.php";
  $('#capa').html('<img src="loader.gif"/>');
    $.ajax({
           type: "POST",
           url: url,
           data: $("#myform").serialize(),
           success: function(data)
           {
              $("#capa").html(data);
           }
         });

    return false;
 });
});

$(function(){
 $("#botonenviardos").click(function(){
 var url = "votodos.php";
  $('#capados').html('Votando <img src="loader.gif"/>');
    var botonenviardos = $("#botonenviardos");
    $.ajax({
           type: "POST",
           url: url,
           data: $("#myformdos").serialize(),
           beforeSend: function () {
            $('#votar').hide();
            },
           success: function(data)
           {
              $("#capados").html(data);
              /*setTimeout(function () {
                $('#capados').hide();
                //$("#votar").fadeIn("slow"); //mostrar
                $("#capanew").fadeIn("slow"); //mostrar
                }, 500);*/
              botonenviardos.attr("disabled", "disabled");
           }
         });

    return false;
 });
});
</script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" style="background-color: #563d7c !important;">
  <span class="navbar-brand">
      <img src="img/logo-mywebsite-urian-viera.svg" alt="Web Developer Urian Viera" width="120">
        Web Developer Urian Viera
  </span>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>

<br><br>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h2 class="display-4">Lista de Videos</h2>
  <hr>
</div>

<?php
include('config.php');
?>
<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Video 1</h4>
      </div>
      <div class="card-body">
        <iframe width="250" height="250" src="https://www.youtube.com/embed/lXhO7tsmlwA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <form name="myform" id="myform" action="" method="post">
            <input type="hidden" name="voto" id="voto" value="1">
             <button type="submit" id="botonenviar" name="botonenviar" class="btn btn-lg btn-block btn-primary">
                <span>
                    Votar Ahora!
                </span>
                <span id="capa">
                <?php
                $result = mysqli_query($con, "SELECT SUM(voto) as total FROM votos");
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    echo "(".$row["total"].")";
                ?>
                </span>
             </button>
        </form>
      </div>
    </div>

    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Video 2</h4>
      </div>
      <div class="card-body">
        <iframe width="250" height="250" src="https://www.youtube.com/embed/THrSJz2uaUI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <form name="myformdos" id="myformdos" action="" method="post">
            <input type="hidden" name="voto" id="voto" value="1">
             <button type="submit" id="botonenviardos" name="botonenviardos" class="btn btn-lg btn-block btn-primary">
                  <span id="votar">
                    <?php
                    function get_ip_address() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }

        } else {

            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))

                return $_SERVER['HTTP_X_FORWARDED_FOR'];

        }
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
          return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];
     return $_SERVER['REMOTE_ADDR'];
}


function validate_ip($ip) {
    if (strtolower($ip) === 'unknown')
        return false;
    $ip = ip2long($ip);
    if ($ip !== false && $ip !== -1) {
       $ip = sprintf('%u', $ip);
        if ($ip >= 0 && $ip <= 50331647) return false;
        if ($ip >= 167772160 && $ip <= 184549375) return false;
        if ($ip >= 2130706432 && $ip <= 2147483647) return false;
        if ($ip >= 2851995648 && $ip <= 2852061183) return false;
        if ($ip >= 2886729728 && $ip <= 2887778303) return false;
        if ($ip >= 3221225984 && $ip <= 3221226239) return false;
        if ($ip >= 3232235520 && $ip <= 3232301055) return false;
        if ($ip >= 4294967040) return false;
    }
    return true;
}

$ip     =  get_ip_address();

    $sqls = ("SELECT * FROM votoxip WHERE ip='".$ip."'");
    $numbers = mysqli_query($con, $sqls);
    $cants = mysqli_num_rows($numbers);
    echo 'Votar Ahora!  ('. $cants .')';
     ?>
                 </span>

                <span id="capados"> </span>

             </button>
        </form>
      </div>
    </div>

    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Video 3</h4>
      </div>
      <div class="card-body">
        <iframe width="250" height="250" src="https://www.youtube.com/embed/w1jkStuRQU8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <button type="button" class="btn btn-lg btn-block btn-primary">Votar Ahora!</button>
      </div>
    </div>
  </div>
</div>



</body>
</html>
