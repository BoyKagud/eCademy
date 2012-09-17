<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-University</title>

<!-- include JS -->
<!-- <script type="text/javascript" src="public/js/jquery.js"></script> -->
<!-- <script type="text/javascript" src="public/js/transit.js"></script> -->
<!-- <script type="text/javascript" src="public/js/jquery.transit.script.js"></script> -->
<script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<!-- get Style -->
<?php
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
		echo "<link rel='stylesheet' type='text/css' href='Style.css'>";
	} else {
		echo "<link rel='stylesheet' type='text/css' href='/e-Cademy/Style.css' />";
	}
?>
</head>

<body>
<div class="wraper">
<div class="header">
<?php print_r($this->session->all_userdata());?>
<div class="navigation">
<ul>
	<li><div class="topMenuItem"><a href='/ecademy'>Home</a></div></li>
	<li><div class="topMenuItem">Help</div></li>
	<li><div class="topMenuItem"><a href="/ecademy/UserAccounts/logout">Log Out</a></div></li>
</ul>
</div>

<div id="logo-div" style="float:left; padding-left:15px;">
<h2>Logo</h2>

<?php $browser = get_browser(null, true);?>
	
	
</div> <!-- logo-div -->
</div> <!-- header -->

<div class="page">