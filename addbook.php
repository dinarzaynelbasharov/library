<html>
	<head>
		<title>Добавление книги</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="button.css">
	</head>
	<center><font size="6" color="white" face="Palatino Linotype">Библиотечная система<br></font></center>
	<br>
	<body>
	<?php
	session_start();
	?>
    <?php
        $s=mysqli_connect("localhost","root","") OR DIE(mysqli_error());
        mysqli_select_db($s, "library");
        mysqli_query($s, "SET NAMES utf8");
        $r=mysqli_query($s,"SELECT author_id, name FROM authors")or die(mysqli_error($s));
        $r2=mysqli_query($s,"SELECT type_id, name FROM types")or die(mysqli_error($s));
        $r3=mysqli_query($s,"SELECT publisher_id, name FROM publishers")or die(mysqli_error($s));
        ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="additem" method="GET"> 
			<input class="txtb" type="text" name="add_bookname" placeholder="Имя книги" required value=""> <br><br>
            <select class="txtb" name="add_author" required value=""><option value="" disabled selected style='display:none;'>Имя автора</option>
                                        <?php while($object = mysqli_fetch_object($r)): ?>
                                        <option value ="<?=$object->author_id?>"><?=$object->name?></option>
                                        <?php endwhile;?>
                                    </select> <br><br>
            <input class="txtb" type="text" name="add_year" placeholder="Год издания" required value=""> <br><br>
            <input class="txtb" type="text" name="add_pages" placeholder="Количество страниц" required value=""> <br><br>
            <select class="txtb" name="add_type" required value=""><option value="" disabled selected style='display:none;'>Вид литературы</option>
                                        <?php while($object2 = mysqli_fetch_object($r2)): ?>
                                        <option value ="<?=$object2->type_id?>"><?=$object2->name?></option>
                                        <?php endwhile;?>
                                    </select> <br><br>
            <select class="txtb" name="add_publisher" required value=""><option value="" disabled selected style='display:none;'>Издатель</option>
                                        <?php while($object3 = mysqli_fetch_object($r3)): ?>
                                        <option value ="<?=$object3->publisher_id?>"><?=$object3->name?></option>
                                        <?php endwhile;?>
                                    </select> <br><br>
	    <input class="txtb" type="text" name="add_amount" placeholder="Количество" required value=""> <br><br>
			<input class="btt" name="submit" type="submit" value="Добавить книгу">  
		</form>
		<?php 		
		if (isset($_GET['add_bookname']) && isset($_GET['add_author']) && isset($_GET['add_year']) && isset($_GET['add_type']) && isset($_GET['add_pages']) && isset($_GET['add_publisher']) && isset($_GET['add_amount']))
		{		
		$a = $_GET['add_bookname'];
		$b = $_GET['add_author'];
        $c = $_GET['add_year'];
        $d = $_GET['add_type'];
        $e = $_GET['add_pages'];		
        $f = $_GET['add_publisher'];
	$g = $_GET['add_amount'];
		$db_table = "books";		
		$result = mysqli_query($s, "INSERT INTO $db_table (name, year, pages, author_id, type_id, publisher_id, amount) VALUES ('$a','$c','$e','$b','$d','$f', '$g')")or die(mysqli_error($s));		 		
		if ($result = 'true'){
         echo "<div style=\"font:bold 24px Palatino Linotype; color:white;\">Книга добавлена!</div>";
		}		
		}
		?>
		<br>
		<a class="aa" href="glav.php">На главную</a>
	
	</body>


</html>