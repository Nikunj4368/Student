<?php

@include('connection.php');


$limit=2;
$start=0;
//$cnt=0;
//session_start();
//$uid=$_SESSION['login_id'];

if(isset($_GET['page']))
{
	$page=$_GET['page'];
	$start=($page-1)*$limit;
}
else
{
	$page=1;
	$start=0;
}

if(isset($_GET['txtsearch']))
{
	$search=$_GET['txtsearch'];
	$select=$_GET['select'];

	if(@$select=="name")
	{
		$sql="select * from `student_data` where `name` like '%$search%' and uid='$uid' limit $start,$limit ";
	}
	
	else{

		$sql="select * from `student_data` where name like '%$search%' and uid='$uid' limit $start,$limit ";
	}
}
else
{
	$sql="select * from `student_data` limit $start,$limit ";
}
$res=mysqli_query($con,$sql);

if(isset($_GET['id'])>0)
{
	$id=$_GET['id'];	
	$del="Delete from `student_data`  where id='$id'";
	mysqli_query($con,$del); 
	header("location:view_student.php");
}

if(isset($_GET['txtsearch']))
{
	$sql_cnt="select * from `student_data` where name like '%$search%' and `uid`=$uid ";
} 
else
{
	$sql_cnt="select * from `student_data` ";
}

$sql_res=mysqli_query($con,$sql_cnt);
$total_res=mysqli_num_rows($sql_res);
$count=ceil($total_res/$limit);

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

		<table border="2" cellpadding="2" cellspacing="2">
				
			<tr>
				<td >ID</td>
				<td>NAME</td>
				<td>GENDER</td>
				<td>ROLL NO</td>
				<td>MOBILE NO</td>
				<td>EMAIL</td>
				<td>ADDRESS</td>
				<td>CITY</td>
				<td>SEM</td>
				<td>ACTION</td>
			</tr>

			<?php

				while($data=mysqli_fetch_assoc($res))
				{

			?>

			<tr>
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['name']; ?></td>
				<td><?php echo $data['gender']; ?></td>
				<td><?php echo $data['rollno']; ?></td>
				<td><?php echo $data['mobino']; ?></td>
				<td><?php echo $data['email']; ?></td>
				<td><?php echo $data['add']; ?></td>
				<td><?php echo $data['city']; ?></td>
				<td><?php echo $data['sem']; ?></td>				
				<td><a href="view_student.php?id=<?php   echo $data['id'];  ?>" onClick="return confirm('Are You Sure...?');" class="a">DELETE</a> <nbsp;> <a href="add_student.php?id=<?php echo $data['id']; ?>" class="a">EDIT</a></td>
			</tr>

			<?php 
				}
			?>

			<tr>
		<td colspan="8">
			<?php  
			if(isset($_GET['txtsearch']))
			{
			?>
			<a href="view_student.php?page=1&txtsearch=<?php echo $search; ?>&select=<?php echo $select; ?> " class="a">First</a>

			<a href="view_student.php?page=<?php echo $page-1; ?>&txtsearch=<?php echo $search; ?>&select=<?php echo $select; ?> " class="a">Prev</a>

			<a href="view_student.php?page=<?php echo $page+1; ?>&txtsearch=<?php echo $search; ?>&select=<?php echo $select; ?>" class="a">Next</a>

			<a href="view_student.php?page=<?php echo $count; ?>&txtsearch=<?php echo $search; ?>&select=<?php echo $select; ?>" class="a">Last</a>

			<?php
			}else{
				?>
				<a href="view_student.php?page=<?php echo $page-1; ?>" class="a">Prev
			</a>
			<a href="view_student.php?page=1" class="a">First
			</a>

			<a href="view_student.php?page=<?php echo $page+1; ?>" class="a">Next</a>

			<a href="view_student.php?page=<?php echo $count; ?>" class="a">Last</a>			

				<?php
			}
			for($i=1;$i<=$count;$i++)
			{ ?>

			<?php

				if(isset($_GET['txtsearch']))
				{ 

			?>
			<a href="view_student.php?page=<?php echo $i; ?>&txtsearch=<?php echo $search; ?>&select=<?php echo $select; ?> " class="a"><?php echo $i; ?></a>

			<?php 
				}
				else
				{

			?>
				
			<a href="view_student.php?page=<?php echo $i; ?>" class="a"><?php echo $i; ?>
			</a>

			<?php  }  ?>

			<?php } ?>
			
			</td>
		</tr>
			
		</table>

	</form>

</center>


</body>
</html>