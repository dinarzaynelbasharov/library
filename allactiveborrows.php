<html>
	<head>
		<title>Активные выдачи</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="button.css">
	</head>
	<center><font size="6" color="white" face="Palatino Linotype">Библиотечная система<br></font></center>
	<br>
	<body >
	<?php
	session_start();
	?>		
		<?php 		 	
		$db=mysqli_connect("localhost","root","") OR DIE(mysql_error());
		mysqli_select_db($db, "library");
		mysqli_query($db, "SET NAMES utf8");
		$result = mysqli_query($db, "SELECT b.name, r.name, bo.borrowdate, bo.returndate
        FROM books AS b, borrows AS bo, readers AS r
        WHERE b.book_id = bo.book_id AND r.reader_id = bo.reader_id AND bo.status = true")or die(mysqli_error($db));	
		$a=mysqli_fetch_array($result);
		echo "<table class=table>";
		echo "<tr><th><b>Название книги</b></th><th><b>ФИО читателя</b></th><th><b>Дата выдачи</b></th><th><b>Дата возврата</b></th><tr>";
		do
		{
			$pole1=$a[0];
			$pole2=$a[1];
            $pole3=$a[2];
            $pole4=$a[3];
			echo "<tr><td>$pole1</td><td>$pole2</td><td>$pole3</td><td>$pole4</td><tr>";
		} while ($a=mysqli_fetch_array($result));
		echo "</table>";
		
		?>
		<br>
		<br>
		<a class="aa" href="glav.php">На главную</a>
	</body>


</html>