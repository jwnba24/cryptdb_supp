<html>
	<head>
		<title>creating</title>
	</head>
	
	<body>
		<?php
			session_start();
			$type=$_REQUEST['type'];
			$name=$_REQUEST['name'];
			
			$link = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], NULL, $_SESSION['port']);
			if($link == false) {
				echo 'ERROR: Could not connect. ' . mysqli_connect_error();
				header("location:index.php");
			}
			
			if ($type == "database") {
				echo 'prev = db';
				$prev='location:databases.php';
			}
			elseif ($type == "table") {
				echo 'prev = table';
				$db=$_REQUEST['db'];
				$prev='location:tables.php?db=' . $db;
				$query = "use " . $db . ";";
				$result = mysqli_query($link, $query);
			}
			
			//semi-colons at end of queries can break for some reason
			$query="CREATE " . $type . " " . $name;
			$result = mysqli_query($link, $query);
			
			header($prev);
		?>
	</body>
</html>
