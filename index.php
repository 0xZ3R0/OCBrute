<html>
<body>
<title>OCStore HashCracker</title>
<style>
body {
  font: 13px/20px "Lucida Grande", Tahoma, Verdana, sans-serif;
   color:  #FFFF00 ; 
  background: #404040;
}
.supertext {
background:#404040;
color:  #FFF; 
font-size:14px;
margin: 7px;
}
input[type='text'] {
            margin-top: 15px; /* уменьшите на свой вкус  */
            margin-bottom: 15px; /* здесь тоже */
  }
  input[type='submit'] {
            margin-top: 15px; /* уменьшите на свой вкус  */
            margin-bottom: 15px; /* здесь тоже */
  }
.superbutton {
margin: 10px;
width:100px;
height:25px;
background:#404040;
color:#fff;
font-size:18px;
color:  #c4c401 ; 
}
</style>
<?php
if (isset($_POST['hash']) && isset($_POST['salt']))
{
$hash = $_POST['hash'];
$salt = $_POST['salt'];
$handle = fopen("passwords.lst", "r");
$passlenght = sizeof (file ("passwords.lst"));
$num = 0;
echo ("Bad hash: <label id='lbl'>".$num."</label>");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
	$txt = preg_replace(
    "/(\t|\n|\v|\f|\r| |\xC2\x85|\xc2\xa0|\xe1\xa0\x8e|\xe2\x80[\x80-\x8D]|\xe2\x80\xa8|\xe2\x80\xa9|\xe2\x80\xaF|\xe2\x81\x9f|\xe2\x81\xa0|\xe3\x80\x80|\xef\xbb\xbf)+/",
    "",
    $line);
    $line = substr($line, 0, -1);
$newhash = sha1($salt . sha1($salt . sha1($line)));
if ($newhash == $hash)
{
echo ("<body bgcolor='#212020'>");
 echo " \n<h1 align='center' style='color:#c4c401;'>Password found</h1>"; 
 echo " \n<h1 align='center' style='color:#47ba0e;'>".$line."</h1>"; 
break;
}
 else
{
	$num++;
	echo ("<script> document.getElementById('lbl').innerHTML=".$num.";</script>");
  if ($num == $passlenght) echo " \n<h1 align='center' style='color:#47ba0e;'>Password not found :(</h1>"; 
}
    }

    
} else {
    echo "Error file reading";
} 
}
else
{
?>
<form action="" method="POST" align="center">
<h1 color="#47ba0e">OpenCart HashCracker by 0x67756e6f37</h1>
<p><input type="text" name="hash" class="supertext" placeholder="Hash"></p>
<p><input type="text" name="salt" class="supertext" placeholder="Salt"></p>
<p><input class="superbutton" type="submit" value="Start"></p>
</body>
</html>
<?
}
?>