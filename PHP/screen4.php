<?php
	include_once 'dbConnect.php';
?>
<!-- screen 4: Book Reviews by Prithviraj Narahari, php coding: Alexander Martens-->
<!DOCTYPE html>
<html>
<head>
<title>Book Reviews - 3-B.com</title>
<style>
.field_set
{
	border-style: inset;
	border-width:4px;
}
</style>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="center">
				<h5>
					<?php
						$titleQuery = "SELECT title, author FROM book WHERE isbn = '".$_GET["isbn"]."'";
						$book = mysqli_query($conn, $titleQuery);
    					$tup = mysqli_fetch_array($book);
						echo "Reviews For: " .$tup["title"]. "</br>By " .$tup["author"];
					?>
				</h5>
			</td>
			<td align="left">
				<h5> </h5>
			</td>
		</tr>
			
		<tr>
			<td colspan="2">
			<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
			<table>
				<tr>
					<?php
						$query = "SELECT * FROM review WHERE isbn = '".$_GET["isbn"]."'";
						$result = mysqli_query($conn, $query);
    					while($row = mysqli_fetch_array($result))
						{
							echo $row["the_review"];
						}
					?>
				</tr>	
			</table>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="Done">
				</form>
			</td>
		</tr>
	</table>

</body>

</html>
