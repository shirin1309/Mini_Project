<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
?>

<style type="text/css">
	#log {
		background-color: rgba(0, 150, 220, 0.5);
		margin: 10px 150px;
		padding: 50px;
		color: white;
		width: 1000px;
		float: left;
	}

	.txtBox {
		height: 45px;
	}

	#txtAdrs {
		height: 70px;
	}
</style>
<div id="log">
	<form method="POST">
		<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Hospital Registration</h3>
		<table style="width:900px;">
			<tr>
				<td>Name</td>
				<td><input type="text" class="form-control txtBox" pattern="[a-zA-Z ]+" name="txtName" required=""></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;Address</td>
				<td><textarea class="form-control txtBox" id="txtAdrs" name="txtAddress" required=""></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Place</td>
				<td><input type="text" class="form-control txtBox" pattern="[a-zA-Z ]+" name="txtPlace" required=""></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;License</td>
				<td><input type="text" class="form-control txtBox" name="txtLicense" required=""></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Pin</td>
				<td><input type="text" class="form-control txtBox" pattern="[6][0-9]{5}" maxlength="6" name="txtPin" required=""></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;Contact</td>
				<td><input type="text" class="form-control txtBox" pattern="[6789][0-9]{9}" name="txtContact" required=""></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" class="form-control txtBox" name="txtEmail" required=""></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;Password</td>
				<td><input type="Password" class="form-control txtBox" name="txtPwd" required=""></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<!-- <td colspan="2"></td>

				<td></td> -->
				<td colspan="4" class="text-center"><input type="submit" style="width:300px;" class="btn btn-warning" name="btnSubmit" required=""></td>
			</tr>
		</table>
	</form>
</div>
<?php

if (isset($_REQUEST['btnSubmit'])) {
	$name = $_REQUEST['txtName'];
	$address = $_REQUEST['txtAddress'];
	$place = $_REQUEST['txtPlace'];
	$pin = $_REQUEST['txtPin'];
	$contact = $_REQUEST['txtContact'];
	$license = $_REQUEST['txtLicense'];
	$email = $_REQUEST['txtEmail'];
	$pwd = $_REQUEST['txtPwd'];

	$q = "select count(*) from login where user_name='$email'";
	$s = mysqli_query($conn, $q);
	$r = mysqli_fetch_array($s);
	if ($r[0] > 0) {
		echo '<script>alert("Email already registered")</script>';
	} else {
		$q = "insert into hospital (name,adrs,place,licen_num,pin,email,contact) values('$name','$address','$place','$license','$pin','$email','$contact')";
		echo $q;
		$s = mysqli_query($conn, $q);
		if ($s) {

			$q = "insert into login (user_name,password,user_type,status) values('$email','$pwd','hospital','1')";
			$s = mysqli_query($conn, $q);
			if ($s) {
				echo '<script>alert("Hospital Added...")</script>';
				echo '<script>location.href="commonhospital.php"</script>';
			} else {
				echo '<script>alert("Sorry some error occured...")</script>';
			}
		} else {
			echo '<script>alert("Sorry some error occured")</script>';
		}
	}
}
?>