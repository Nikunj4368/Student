<?php

@include('connection.php');

session_start();
$nameerr=false;

$rollerr=false;
$mobierr=false;
$emailerr=false;
$adderr=false;
$cityerr=false;
$semerr=false;


if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$sql_sel="select * from `student_data` where id=".$id;
	$sql_res=mysqli_query($con,$sql_sel);
	$data=mysqli_fetch_assoc($sql_res);
}


if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$gender=$_POST['gender'];
	$rollno=$_POST['rollno'];
	$mobino=$_POST['mobino'];
	$email=$_POST['email'];
	$add=$_POST['add'];
	$city=$_POST['city'];
	$sem=$_POST['sem'];	
	
	
	$uid=$_SESSION['login_id'];

	if(!empty($name))
	{
		$nameerr=true;
	}
	else
	{
		echo " <br> Enter name...!";
	}
		
	if(!empty($rollno))
	{
		$rollerr=true;
	}
	else
	{
		echo " <br> Enter roll no...!";
	}
	
	if(!empty($mobino))
	{
		$mobierr=true;
	}
	else
	{
		echo " <br> Enter mobile no...!";
	}
	
	if(!empty($email))
	{
		$emailerr=true;
	}
	else
	{
		echo " <br> Enter Email...!";
	}

	if(!empty($add))
	{
		$adderr=true;
	}
	else
	{
		echo " <br> Enter add...!";
	}

	if(!empty($city))
	{ 	
		$cityerr=true;
	}
	else
	{
		echo " <br> Select City...!";
	}

	if(!empty($sem))
	{
		$semerr=true;
	}
	else
	{
		echo " <br> Select Semester...!";
	}

	if($nameerr==true && $rollerr==true && $mobierr==true && $emailerr==true && $adderr==true && $cityerr==true && $semerr==true)
	{

	if(isset($_GET['id'])>0)
	{

		$update="update `student_data` set `name`='$name',`gender`='$gender',`rollno`='$rollno',`mobino`='$mobino',`email`='$email',`add`='$add',`city`='$city',`sem`='$sem' where `id`=".$_GET['id'];
			mysqli_query($con,$update);
			header("location:view_student.php");
	}

	else
	{																							
		$ins="insert into `student_data` (`name`,`gender`,`rollno`,`mobino`,`email`,`add`,`city`,`sem`) values ('$name','$gender','$rollno','$mobino','$email','$add','$city','$sem')"; 
		mysqli_query($con,$ins);
		header("location:view_student.php");
	}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>STUDENT DETAILS</title>
	<link rel="stylesheet" type="text/css" href="css\main_header.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<div>

	<ul class="main_menu">
		<li><a href="add_student.php">ADD STUDENT</a></li>
		<li><a href="view_student.php">VIEW STUDENT</a></li>
	</ul>

</div>

<center>
	<h1>STUDENT DETAILS</h1>
	<form method="post">
		<table>
			<tr>
				<td><br></td>
				<td>Name : </td>
				<td><input type="text" name="name" value="<?php echo @$data['name']; ?>"></td>
			</tr>
			
			<tr>
				<td><br></td>
				<td>Gender : </td>
				<td><input type="radio" name="gender" value="female">Female
				<input type="radio" name="gender" value="male" checked="checked">Male</td>
			</tr>
			
			<tr>	
				<td><br></td>
				<td>Roll No : </td>
				<td><input type="text" name="rollno" value="<?php echo @$data['rollno']; ?>"></td>
			</tr>
			
			<tr>
				<td><br></td>
				<td>Mobile No : </td>
				<td><input type="text" name="mobino" value="<?php echo @$data['mobino']; ?>"></td>
			</tr>
			
			<tr>
				<td><br></td>
				<br><td>Email : </td>
				<td><input type="text" name="email" value="<?php echo @$data['email']; ?>"></td>
			</tr>
			
			<tr>
				<td><br></td>
				<td>Address : </td>
				<td><textarea name="add"><?php  echo @$data['add']; ?></textarea></td>
			</tr>
			
			<tr>
				<td><br></td>
				<td>City : </td>
				<td><select name="city">
						<option>select city</option>
						<option value="surat" <?php if(@$data['city']=="surat"){ echo 'selected'; } ?>>SURAT</option>
						<option value="ahmedabad" <?php if(@$data['city']=="ahmedabad"){ echo 'selected'; } ?>>AHMEDABAD</option>
						<option value="baroda" <?php if(@$data['city']=="baroda"){ echo 'selected'; } ?>>baroda</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td><br></td>
				<td>Semester : </td>
				<td><select name="sem">
						<option>select semester</option>
						<option value="sem1" <?php if(@$data['sem']=="sem1"){ echo 'selected'; } ?>>SEM1</option>
						<option value="sem2" <?php if(@$data['sem']=="sem2"){ echo 'selected'; } ?>>SEM2</option>
						<option value="sem3" <?php if(@$data['sem']=="sem3"){ echo 'selected'; } ?>>SEM3</option>
						<option value="sem4" <?php if(@$data['sem']=="sem4"){ echo 'selected'; } ?>>SEM4</option>
						<option value="sem5" <?php if(@$data['sem']=="sem5"){ echo 'selected'; } ?>>SEM5</option>
						<option value="sem6" <?php if(@$data['sem']=="sem6"){ echo 'selected'; } ?>>SEM6</option>
					</select>
				</td>
			</tr>
			
			<tr></tr><tr></tr>
			<tr>
				<td></td>
				<br><td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
			</tr>
		</table>
	</form>
</center>

</body>
</html>
