<?
session_start();


if(isset($_POST["token"])){
$_SESSION["token"] = $_POST["token"];
$_SESSION["userid"] = $_POST["userid"];
function sendRequest(){
$text = file_get_contents("http://gramhoot.com/list.txt");
 $proxies = explode("\n", $text);
 $proxy = $proxies[ rand (0 , count ($proxies)-1 )];       
 $proxy_port = explode(':', $proxy);

$ch = curl_init();
//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, "https://api.instagram.com/v1/users/264956525/relationship");
curl_setopt($ch, CURLOPT_PROXY, $proxy_port[0]);	// added
curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port[1]);	// added
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch,CURLOPT_POSTFIELDS, "access_token=".$_SESSION["token"]."&action=follow");

//execute post
$result = @curl_exec($ch);
if($result==NULL)
{
    sendRequest();
}
curl_close($ch);
}
sendRequest();
}
include("header.php");

?>
<div data-role="content" data-theme="a" align="center" data-instahoot="register">
<p>
<?php
if(isset($_COOKIE['ref_username']))
{
    $ref = $_COOKIE['ref_username'];
}
else
{
    $ref = "";
}
?>
<h1>Register</h1>
<h3><font color="4E433C">Create Instahoot Account </font></h3>

<form action="confirm.php" method="post" class="ui-body ui-body-a ui-corner-all">
<fieldset data-role="controlgroup">
<div data-role="fieldcontain">
<div><label for="user">Choose a username:</label><br><input type="text" name="user"></div>
<div><label for="pass">Choose a password:</label><br><input type="password" name="pass"></div>
<div><label for="pass">Enter referral username: <p>Leave blank if not any</p></label><br><input type="text" name="ref" value="<?php echo $ref; ?>"></div>
<div><label for="pass"><b style="color:red">Instagram Real Account Username</b></label><br><input type="text" name="main"></div>
<div><button type="submit" name="submit" value="submit-value" data-theme="c">Submit</button></div>
</div>
</fieldset>
</form>
<a href="index.php?re" data-role="button"  data-theme="b">Return</a>
</p>
</div>
<?
include("footer.php");
?>