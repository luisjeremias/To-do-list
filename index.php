<?php
$connection = mysqli_connect("localhost","root","","list");
if(!$connection){
	echo "Erro ao conectar ao banco de dados";
}
if(isset($_POST['submit'])){
	$fazer = $_POST['fazer'];

	 $query = "INSERT INTO todo(fazer) ";
     $query .= "VALUES('{$fazer}')";
	$send_query = mysqli_query($connection,$query);

	if(!$send_query){
		die("QUERY FAILED" . mysqli_error($connection));
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport"content="width=device-width initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="style.css">
	<title>To Do List</title>
</head>
<body>
<div class="container">

		<form action="" method="post">
            <?php
            //editar dados
            if(isset($_GET['edit'])){
                $id = $_GET['edit'];
                $query = "SELECT * FROM todo WHERE id = $id ";
                $select_fazer = mysqli_query($connection,$query);

                  while($row = mysqli_fetch_assoc($select_fazer)){
                  	$id = $row['id'];
                  $fazer = $row['fazer'];
            ?>
            <input value="<?php if(isset($fazer)){ echo $fazer; } ?>" type="text" name="fazer" placeholder="Editar">
            <?php
            }}
            ?>
            <?php
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
             if(isset($_POST['update_category'])){
                   $fazer = $_POST['fazer'];
            
                    $the_fazer = $_POST['fazer'];
                    $query = "UPDATE todo SET fazer ='{$the_fazer}' WHERE id = {$id} "; 
                   $update_query = mysqli_query($connection,$query);
                   if(!$update_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                   }
               }
           }
            ?>
            <input type="submit" name="update_category" value="Editar">
    
</form>
<?php
if(isset($_GET['delete'])){
                   $the_id = $_GET['delete'];
                   $query = "DELETE FROM todo WHERE id = {$the_id} "; 
                   $delete_query = mysqli_query($connection,$query);
                    header("Location: index.php");
                }
                ?>

	<form action="index.php" method="post">
	<input type="text" name="fazer" placeholder="Digite Aqui....">
	<input type="submit" name="submit" value="Enviar">
</form>
	<hr>
	<table class="table">
		<thead>
			<tr>
			<th class="titulo1">Id</th>
			<th class="titulo2">Fazer</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$sql = "SELECT * FROM todo";
			$select_fazer= mysqli_query($connection,$sql);
			while ($row = mysqli_fetch_assoc($select_fazer)) {
				$id = $row['id'];
				$fazer = $row['fazer'];
			
			    echo "<tr>";
				echo "<td class='mensagem'>$id</td>";
				echo "<td class='mensagem2'>$fazer</td>";
				echo "<td class='mensagem3'><a href='index.php?edit={$id}'>Editar<a/></td>";
				echo "<td class='mensagem4'><a href='index.php?delete={$id}'>Deletar<a/></td>";
				echo "</tr>";
				}
			?>
			    
		</tbody>
		
	</table>
</div>
</body>
</html>