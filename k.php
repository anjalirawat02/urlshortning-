<?php
$conn=mysqli_connect("localhost","root","","anjali");
$link=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on'? "https" : "http") . "://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$arry_link=explode("k.php?", $link);
$short_code=$arry_link['1'];
$qry_ex = mysqli_query($conn, "SELECT `orig_url` FROM `links` WHERE `short_code` = '$short_code'");
$res = mysqli_fetch_assoc($qry_ex);
$orig_url = $res['orig_url'];
header("Location: $orig_url");
?>
