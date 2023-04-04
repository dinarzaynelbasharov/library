<html>
	<head>
		<title>Взятие книги</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="button.css">
	</head>
	<center><font size="6" color="white" face="Palatino Linotype">Библиотечная система<br></font></center>
	<br>
	<body>
	
    <?php
	session_start();
	$login = $_SESSION['Name'];
        $s=mysqli_connect("localhost","root","") OR DIE(mysqli_error());
        mysqli_select_db($s, "library");
        mysqli_query($s, "SET NAMES utf8");
	$getnum = mysqli_query($s,"SELECT reader_id FROM readers WHERE login = '$login'")or die(mysqli_error($s));
	$getnum2=mysqli_fetch_array($getnum);
	$num = $getnum2[0];
        $r=mysqli_query($s,"SELECT book_id, CONCAT(b.name, ' - ', a.name) AS full  FROM books AS b, authors AS a WHERE a.author_id = b.author_id AND amount > 0")or die(mysqli_error($s));
        $r2=mysqli_query($s,"SELECT type_id, name FROM types")or die(mysqli_error($s));
        $r3=mysqli_query($s,"SELECT publisher_id, name FROM publishers")or die(mysqli_error($s));
        ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="additem" method="GET"> 
            <select class="txtb" name="add_book" required value=""><option value="" disabled selected style='display:none;'>Название книги</option>
                                        <?php while($object = mysqli_fetch_object($r)): ?>
                                        <option value ="<?=$object->book_id?>"><?=$object->full?></option>
                                        <?php endwhile;?>
                                    </select> <br><br>
			<input class="btt" name="submit" type="submit" value="Взять книгу">  
		</form>
		<?php 		
		if (isset($_GET['add_book']))
		{		
		$b = $_GET['add_book'];
		$db_table = "borrows";		
		$result = mysqli_query($s, "INSERT INTO $db_table (borrowdate, returndate, book_id, reader_id, status) VALUES (CURDATE(), CURDATE() + interval 14 day,'$b','$num', true)")or die(mysqli_error($s));	
        $res = mysqli_query($s, "SELECT DAYOFMONTH(CURDATE() + interval 14 day), MONTHNAME(CURDATE() + interval 14 day), YEAR(CURDATE() + interval 14 day)")or die(mysqli_error($s));
        $rrrr=mysqli_fetch_array($res);
        $res1 = $rrrr[0];
        $res2 = $rrrr[1];
        $res3 = $rrrr[2];		
		if ($result = 'true'){
         echo "<div style=\"font:bold 24px Palatino Linotype; color:white;\">Книга взята! Её следует вернуть до $res1 $res2 $res3. Либо продлить срок сдачи.</div>";
		mysqli_query($s, "UPDATE books SET amount = amount - 1 WHERE book_id = $b")or die(mysqli_error($s));
		}		
		}
		?>
		<br>
		<a class="aa" href="glav.php">На главную</a>
	
	</body>


</html>