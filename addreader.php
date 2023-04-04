<html>
	<head>
		<title>Добавление информации о читателе</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="button.css">
	</head>
	<center><font size="6" color="white" face="Palatino Linotype">Библиотечная система<br></font></center>
	<br>
	<body>
	<?php
	session_start();
	$login = $_SESSION['Name'];
	?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="additem" method="GET"> 
			<input class="txtb" type="text" name="add_name" placeholder="ФИО читателя" required value=""> <br><br>
            <input class="txtb" type="text" name="add_phone" placeholder="Номер телефона (вместе с 8)" required value=""> <br><br>
            <input class="txtb" type="text" name="add_mail" placeholder="Электронная почта" required value=""> <br><br>
            <input class="txtb" type="date" name="add_birth" placeholder="Дата рождения" required value=""> <br><br>
			<input class="btt" name="submit" type="submit" value="Добавить читателя">  
		</form>
		<?php 		
		if (isset($_GET['add_name']) && isset($_GET['add_phone']) && isset($_GET['add_mail']) && isset($_GET['add_birth']))
		{		
		$a = $_GET['add_name'];
        $b = $_GET['add_phone'];
        $c = $_GET['add_mail'];
        $d = $_GET['add_birth'];
        $db_table = "readers";		
		$db=mysqli_connect("localhost","root","") OR DIE(mysqli_error());
		mysqli_select_db($db, "library");	
		mysqli_query($db, "SET NAMES utf8");
		$result = mysqli_query($db, "UPDATE readers SET name = '$a', phonenumber = '$b', email = '$c', dateofbirth = '$d' WHERE login = '$login'")or die(mysqli_error($db));	
		$result2 = mysqli_query($db, "SELECT reader_id FROM readers WHERE login = '$login'")or die(mysqli_error($db));
		$a2=mysqli_fetch_array($result2);
		$res = $a2[0];
		if ($result = 'true'){
         echo "<div style=\"font:bold 24px Palatino Linotype; color:white;\">Читатель добавлен! Номер читательского билета: $res</div>";
		}		
		}
		?>
		<br>
		<a class="aa" href="glav.php">На главную</a>
	
	</body>

</html>