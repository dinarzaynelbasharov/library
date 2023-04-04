<html>
	<head>
		<title>Книги</title>
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
		$result = mysqli_query($db, "SELECT b.book_id, b.name, b.year, t.name, a.name, b.pages, p.name, b.amount
        FROM books AS b JOIN types AS t ON b.type_id = t.type_id
        JOIN authors AS a ON b.author_id = a.author_id
        JOIN publishers AS p ON b.publisher_id = p.publisher_id
        ORDER BY 1")or die(mysqli_error($db));	
		$a=mysqli_fetch_array($result);
		echo "<table class=table>";
		echo "<tr><th><b>№</b></th><th><b>Название книги</b></th><th><b>Год издания</b></th><th><b>Вид литературы</b></th><th><b>Автор</b></th><th><b>Кол-во страниц</b></th><th><b>Издатель</b></th><th><b>Наличие (шт.)</b></th><tr>";
		do
		{
			$pole1=$a[0];
			$pole2=$a[1];
            $pole3=$a[2];
            $pole4=$a[3];
            $pole5=$a[4];
            $pole6=$a[5];
            $pole7=$a[6];
		$pole8=$a[7];
			echo "<tr><td>$pole1</td><td>$pole2</td><td>$pole3</td><td>$pole4</td><td>$pole5</td><td>$pole6</td><td>$pole7</td><td>$pole8</td><tr>";
		} while ($a=mysqli_fetch_array($result));
		echo "</table>";
		
		?>
		<br>
		<br>
		<a class="aa" href="glav.php">На главную</a>
	</body>


</html>