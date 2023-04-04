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
	?>
	<?php
        $s=mysqli_connect("localhost","root","") OR DIE(mysqli_error());
        mysqli_select_db($s, "library");
        mysqli_query($s, "SET NAMES utf8");
        $r=mysqli_query($s,"SELECT book_id, name FROM books")or die(mysqli_error($s));
        ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="additem" method="GET"> 
		<select class="txtb" name="add_book" required value=""><option value="" disabled selected style='display:none;'>Название книги</option>
                                        <?php while($object = mysqli_fetch_object($r)): ?>
                                        <option value ="<?=$object->book_id?>"><?=$object->name?></option>
                                        <?php endwhile;?>
                                    </select> <br><br>
			<input class="btt" name="submit" type="submit" value="Удалить книгу">  
		</form>
		<?php 		
		if (isset($_GET['add_book'])){		
		$code = $_GET['add_book'];				
		$db_table = "books"; 	
		$db=mysqli_connect("localhost","root","") OR DIE(mysqli_error());
		mysqli_select_db($db, "library");	
		$result = mysqli_query($db, "DELETE from $db_table  WHERE book_id = '$code'");		 		
		if ($result = 'true'){
         echo "<div style=\"font:bold 24px Palatino Linotype; color:white;\">Книга удалена из базы!</div>";;
		}
		}
		?>
		<br>
		<a class="aa" href="glav.php">На главную</a>
	</body>


</html>