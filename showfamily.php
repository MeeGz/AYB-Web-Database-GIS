<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
$result = mysqli_query($conn,"SELECT * FROM family");

$content = "<br><br><br>";
$content .= "<div class='container'>";

$content .= "<table class='table'>
			<thead>
			<tr>
				<th>Family ID</th>
				<th>House Code</th>
				<th>Number of Members</th>
				<th>Floor Number</th>
				<th>AppartmentNo</th>
				<th>Family Income</th>
				<th>Roof</th>
			</tr>
			</thead>";

while($row = mysqli_fetch_array($result))
{
	$content .= "<tbody>";
	$content .= "<td>" . $row['familyID'] . "</td>";
	$content .= "<td>" . $row['houseCode'] . "</td>";
	$content .= "<td>" . $row['noFamilyMembers'] . "</td>";
	$content .= "<td>" . $row['floorNo'] . "</td>";
	$content .= "<td>" . $row['appartmentNo'] . "</td>";
	$content .= "<td>" . $row['familyIncome'] . "</td>";
	$content .= "<td>" . $row['roof'] . "</td>";

	
	$content .= "</td>";

}
$content .= "</tbody";
$content .= "</table>";
$content .= "</div>";

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/add.css">
	<style>
		body {margin: 0;}

		ul.topnav {
		    list-style-type: none;
		    margin: 0;
		    padding: 0;
		    overflow: hidden;
		    background-color: #333;
		}

		ul.topnav li {float: left;}

		ul.topnav li a {
		    display: block;
		    color: white;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		}

		ul.topnav li a:hover:not(.active) {background-color: #111;}

		ul.topnav li a.active {background-color: #4CAF50;}

		ul.topnav li.right {float: right;}
		td{
			direction: rtl;
		}
		table {
		    border-collapse: collapse;
		    width: 100%;
		}
		th, td {
		    text-align: left;
		    padding: 8px;
		}
		tr:nth-child(even){background-color: #f2f2f2}
		a{
			text-align: center
		}
		img{
			height: 50px;
		}
		th{
			width: 11%;
			background-color: silver;
		}
		td {
		    word-break: break-all;
		}
		span{
			font-size: 20px;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="">
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Log out</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-header">
            <li><a><?php echo $_COOKIE["admin"]; ?></a></li>
        </ul>
      </div>
    </nav>
	<div class="container">
	<div class="row">
        <a href="crew.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
    </div>
	<?php echo $content; ?>
	<div class="row">
        <!-- <a href="crew.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br> -->
    </div>
	</div>

</body>
</html>
