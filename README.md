# URL Shortning Service
## Follow these steps for creating Url Shortner
Welcome to the URL-shortener Service. This is a site created in PHP that will shorten the given long URL to a URL with a 
fewer alphanumeric characters randomly with a fixed size and while clicked will redirect to the original site...
### Download the xampp server from google
It conatains the apache server and mysql so first start them by going in xampp control.
### Database
Write a query in phpmyadmin
```
CREATE DATABASE anjali; 
USE anjali; 
CREATE TABLE links ( id INT AUTO_INCREMENT PRIMARY KEY, orig_url VARCHAR(255) NOT NULL, short_code VARCHAR(10) NOT NULL );
```
### This is my basic HTML form:
```
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
```
### Connection to the database 
```
if(isset($_POST['url_sub'])){
$conn=mysqli_connect("localhost","root","","anjali");
if(!$conn){
   echo "Connection error";
   exit();
}
```
### Generating the short code 
After generating the short code insert it to the database table. My table name is links.
```
$orig_url=$_POST['input_url'];
$rand= substr(md5(microtime()),rand(0,26),3);
mysqli_query($conn,"INSERT INTO links (orig_url,short_code) VALUES ('$orig_url','$rand')");
echo "your short link is: <br>";
echo "<a href=http://localhost/anjali/k.php?"."$rand>localhost/anjali/k.php?$rand</a>";
```
### Redirecting the short code to the original site
```
$conn=mysqli_connect("localhost","root","","anjali");
$link=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on'? "https" : "http") . "://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$arry_link=explode("k.php?", $link);
$short_code=$arry_link['1'];
$qry_ex = mysqli_query($conn, "SELECT `orig_url` FROM `links` WHERE `short_code` = '$short_code'");
$res = mysqli_fetch_assoc($qry_ex);
$orig_url = $res['orig_url'];
header("Location: $orig_url");
```
### .htaccess
.htaccess file can be used to manipulate behaviour of the site... There are certain rules that can be written on .htaccess file as per requirement... 
For that:
Go to "C:\xampp\apache\conf\extra\httpd-xampp.conf"
and change Require local to Require all granted.
Now Restart the apache server.
