<?php
include ('conn.php');
$emailErr="";
$tmreg="";
if(isset($_REQUEST['reg']))
{
	$tmnam=$_REQUEST['tm_nm'];
	$m1nam=$_REQUEST['m1_nm'];
	$m2nam=$_REQUEST['m2_nm'];
	$clg_nm=$_REQUEST['cl_nm'];
	$emid=$_REQUEST['emid'];

	$sq="select * from teams where team_nm='$tmnam'";
	$res=$conn->query($sq);
	$chk=$res->num_rows;


	if (!filter_var($emid, FILTER_VALIDATE_EMAIL)) {
  		$emailErr = "Invalid email format";
	}
	elseif ($chk==1) {

		$tmreg="Team name is already taken";
	}
	else
	{
		$sq="insert into teams(team_nm,mem1_nm,mem2_nm,clg_nm,email_id) values ('$tmnam','$m1nam','$m2nam','$clg_nm','$emid')";
		$res=$conn->query($sq);

		if($res)
		{
			
			$to=$emid;
			$sub="Registration in i.OHunt event";
			$msg="Dear Participant,

Greetings from team i.OHunt!

Your TEAM $tmnam with TEAM MEMBERS- $m1nam and $m2nam,
     is receiving this mail as you have successfully registered for the event. The event will be live on 25th October, 2017, as a part of i.Fest. Please check our Facebook and Instagram page for more details. And don’t forget to hit the like button!

RULES FOR PARTICIPATING:

-To participate in the event, the team size must be two.

-There are no restrictions on searching for the questions. You can search on any search engine and take reference from any site of your choice.

-The event will be live for only 120 minutes.

-There will be three prizes for the winner and the first and second runner ups. The positions will be decided solely on the basis of individual timings.

-No clarifications regarding the questions or the clues will be given during the event.

-All the sufficient clues will be provided at the bottom of the source code of the page. In case you don’t know how to see the source code of the page, right click anywhere on the page and select ‘View Source’ option.

-To go to the next destination, you have to delete the letters between ‘.php’ at the end of the URL and the first ‘/’ form the right, and type the answer of the current puzzle in its place. For example, the current URL is “abc/random/url.php” and the answer to the current question is “answer”. Hence the new URL for you will be “abc/random/answer.php” 

-Bring pens and papers along with yourself as you might need them during the event.



For more details, contact: Jalansh - 7984683315 or Nidhi - 8849736304.

Adios amigo!

Regards,
Team i.OHunt.
";
			$headers = "From: iohunt.ifest@gmail.com";
			mail($to,$sub,$msg,$headers);
			?>
			<script type="text/javascript">
				alert('Registered Succesfully');
				
			</script>


			<?php



			
		}
		else
		{
			echo "Not Success :((";
		}
	}

	


}
?>
<!DOCTYPE html>
<html>
<head>
	<title>REGISTER</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>

<H1><center>Team  Registration</center></H1>
<form action="" method="POST">
	
<table cellspacing="5">
	<tr>
		<th>Team Name &nbsp &nbsp &nbsp &nbsp:<input type="text" name="tm_nm" required="yes" style="width: 40%"></th>
		<td><b><span class="errorteam" style="font-size: 20px"> <?php echo $tmreg;?></span></b></td>
	</tr>
	<tr>
		<th>Member1 Name:<input type="text" name="m1_nm" required="yes" style="width: 40%"></th>
		<td></td>
	</tr>
	<tr>
		<th>Member2 Name:<input type="text" name="m2_nm" required="yes" style="width: 40%"></th>
		<td></td>
	</tr>
	<tr>
		<th>College Name &nbsp &nbsp:<input type="text" name="cl_nm" required="yes" style="width: 40%;"></th>
		<td></td>
	</tr>
	<tr>
		<th>Email ID &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp:<input type="text" name="emid" required="yes" style="width: 40%">
  </th>
		<td><b><span class="erroremail" style="font-size: 20px"> <?php echo $emailErr;?></span></b></td>
	</tr>
	<tr>
		<th></th>
		<td><input type="submit" name="reg" value="Register" style="width: 70%;height: 40px;font-size: 25px; background-color: lightblue;"  ></td>
	</tr>
	
</table>


</form>
</body>
</html>