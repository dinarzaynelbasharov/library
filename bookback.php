<html>
	<head>
		<title>Удаление книги</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="button.css">
	</head>
	<center><font size="6" color="White" face="Palatino Linotype">Библиотечная система<br></font></center>
	<br>
	<body >
	<?php
	session_start();
	$login = $_SESSION['Name'];
        $s=mysqli_connect("localhost","root","") OR DIE(mysqli_error());
        mysqli_select_db($s, "library");
        mysqli_query($s, "SET NAMES utf8");
	$getnum = mysqli_query($s,"SELECT reader_id FROM readers WHERE login = '$login'")or die(mysqli_error($s));
	$getnum2=mysqli_fetch_array($getnum);
	$num = $getnum2[0];
        $r=mysqli_query($s,"SELECT b.book_id, CONCAT(b.name, ' - ', a.name) AS full
		FROM books AS b, borrows AS bo, authors AS a 
		WHERE b.book_id = bo.book_id 
		AND b.author_id = a.author_id 
		AND bo.reader_id = $num 
		AND bo.status = true")or die(mysqli_error($s));
        ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="additem" method="GET"> 
        <select class="txtb" name="add_book" required value=""><option value="" disabled selected style='display:none;'>Название книги</option>
                                        <?php while($object = mysqli_fetch_object($r)): ?>
                                        <option value ="<?=$object->book_id?>"><?=$object->full?></option>
                                        <?php endwhile;?>
                                    </select> <br><br>
			<input class="btt" name="submit" type="submit" value="Вернуть книгу">  
		</form>
		<?php 		
		if (isset($_GET['add_book'])){		
		$code = $_GET['add_book'];				
		$db_table = "borrows"; 	
		$db=mysqli_connect("localhost","root","") OR DIE(mysqli_error());
		mysqli_select_db($db, "library");	
		$result = mysqli_query($db, "UPDATE borrows SET status = false WHERE book_id = '$code' AND reader_id = $num");		 		
		if ($result = 'true'){
         echo "<div style=\"font:bold 24px Palatino Linotype; color:white;\">Книга успешно возвращена!</div>";
		mysqli_query($db, "UPDATE books SET amount = amount + 1 WHERE book_id = '$code'");	
		}
		}
		?>
		<br>
		<a class="aa" href="glav.php">На главную</a>
	</body>


</html>