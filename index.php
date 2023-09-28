<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener</title>
</head>
<body>
<centre>
<div style="padding:30px;">   
    <h1>URL Shortener</h1>
    <form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="text" name="input_url" required style ="width:50%; padding:10px; font -size:1.5em;">
        <input type="submit" name="url_sub" value="Shorten">
    </form>
</div>
</centre>
</body>
</html>
<?php
if(isset($_POST['url_sub'])){

$conn=mysqli_connect("localhost","root","","anjali");
if(!$conn){
   echo "Connection error";
   exit();
}
$orig_url=$_POST['input_url'];
$rand= substr(md5(microtime()),rand(0,26),3);
mysqli_query($conn,"INSERT INTO links (orig_url,short_code) VALUES ('$orig_url','$rand')");
echo "your short link is: <br>";
echo "<a href=http://localhost/anjali/k.php?"."$rand>localhost/anjali/k.php?$rand</a>";
}
?>