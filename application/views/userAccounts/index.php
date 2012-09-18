<?php 
$data = $this->session->userdata('isLoggedIn');
if (isset($data) && $data == 1) {
	header("Location: /eCademy/index.php/Courses/view");
} elseif (isset($_POST['loginUname'])) {
	$log = new UserAccounts();
	$log->logIn();
} else { $this->session->all_userdata();?>

<div id="login_center">
	<div id="request_login_wraper" class="LFWraper">
		<div class="centerBox">
			<form action="#" method="POST">
				<input type="text" name="loginUname" placeholder="Username"/> <br /><br />
				<input type="password" name="loginPass" placeholder="Password" /> <br /><br />
				<input type="submit" value="Log in" />
			</form>
		</div> <!-- centerBox -->
	</div> <!-- login_form_wraper -->
	
	<div id="login_form_wraper" class="LFWraper">
		<div class="centerBox">
			<form action="#" method="POST">
				<input type="text" name="idNum" placeholder="id-Number"/> <br /><br />
				<input type="text" name="email" placeholder="E-mail Address"/> <br /><br />
				<input type="submit" value="Request Password" />
			</form>
		</div> <!-- centerBox -->
	</div> <!-- login_form_wraper -->
</div> <!-- login-center -->

<div id="login_inst_text">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
	sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
	 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
</p>
</div>


<?php } ?>
