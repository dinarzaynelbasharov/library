<html>
	<head>
		<title>Главная</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="button.css">
	</head>
	<body>
	<center><font size="6" color="White" face="Palatino Linotype">Библиотечная система<br></font></center>
	<div class="leftleft">
	<a class="aa" href="books.php">Книги</a><br>
	<a class="aa" href="publishers.php">Издательские дома</a><br>
	<?php
	session_start();
	if(isset($_SESSION['Name'])){
		$login = $_SESSION['Name'];
	}
	$db=mysqli_connect("localhost","root","") OR DIE(mysqli_error());
		mysqli_select_db($db, "library");	
		mysqli_query($db, "SET NAMES utf8");
	if(isset($_SESSION['Name'])){
		$result = mysqli_query($db, "SELECT * FROM readers WHERE login = '$login' AND name IS NULL")or die(mysqli_error($db));
		$result2 = mysqli_fetch_array($result);
	}
	if(isset($_SESSION['Name']))
	{
		if ($result2 && $_SESSION['Name'] != "admin") {
			echo '<div class="leftleft">
			<a class="aa" href="addreader.php">Добавить информацию</a>';
			}
	echo '<div class="leftleft">
	<a class="aa" href="borrowbook.php">Взять книгу</a>
	<a class="aa" href="dateexp.php">Продлить книгу</a>
	<a class="aa" href="bookback.php">Вернуть книгу</a>';
	if($_SESSION['Name'] == "admin")
	{
	echo '<div class="leftleft">
	<a class="aa" href="allactiveborrows.php">Активные выдачи</a>
	<a class="aa" href="allborrows.php">Все выдачи</a>
	<a class="aa" href="addauthor.php">Добавить автора</a>
	<a class="aa" href="addbook.php">Добавить книгу</a>
	<a class="aa" href="deletebook.php">Удалить книгу</a>
	<a class="aa" href="allreaders.php">Список всех читателей</a>
	</div>';
	};
	};
	?>
	<div><a class="down" href="logout.php">Выйти</a></div>	
	</body>


</html>