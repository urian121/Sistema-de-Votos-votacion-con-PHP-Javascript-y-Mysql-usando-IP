<?php
sleep(1);
include('config.php');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha = date('Y-m-d H:i:s');

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


$voto   = $_REQUEST['voto'];
$ip     =  get_ip_address();

$query = "INSERT INTO votos(
    ip,
    fecha,
    voto
    )
VALUES (
    '" .$ip. "',
    '" .$fecha. "',
    '" .$voto. "'
)";
$result = mysqli_query($con, $query);
if ($result > 0) {
$result = mysqli_query($con, "SELECT SUM(voto) as total FROM votos");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
echo $row["total"];
}
?>
