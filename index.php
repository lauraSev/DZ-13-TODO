<?php
$dbh = new PDO('mysql:host=localhost;dbname=severyuhina', "severyuhina", "neto1715");

$res = $dbh->query("SET NAMES 'utf-8'");
$res = $dbh->query("SET NAMES utf8 COLLATE utf8_general_ci");
$res = $dbh->query("SET time_zone = '+00:00'");
$res = $dbh->query("SET foreign_key_checks = 0");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ToDo</title>
</head>

<body>
<?php 
	if ($_GET ['action'] == 'add') {
    	$query = "INSERT INTO tasks SET 
			description = '".$_REQUEST['description']."',
			date_added = NOW()
		";	
		$res = $dbh->query($query);
	}
	if ($_GET ['action'] == 'done') {
    	$query = "UPDATE tasks SET 
			is_done = 1
			WHERE id = '".$_REQUEST['id']."'
		";	
		$res = $dbh->query($query);
	}
	if ($_GET ['action'] == 'del') {
    	$query = "DELETE FROM tasks 
			WHERE id = '".$_REQUEST['id']."'
		";	
		$res = $dbh->query($query);
	}
	
?>
<form action="index.php?action=add" method="post">
    <p><input type="text" name="description" value="<?= isset ($_REQUEST['description'])?$_REQUEST['description']: '' ?>" placeholder="Описание задачи"><input type="submit" value="Добавить" name="btn"></p>
</form>

<table border="1" width="100%">
    <thead>
    <tr>
        <th>Описание задачи</th>
        <th>Дата добавления</th>
        <th>Статус</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <pre>
<?php
  $res = $dbh->query("SELECT * FROM tasks");
  //print_r($dbh->errorInfo());
  	foreach ($res as $row){
?>
<tbody>
      <tr>
        <td><?= $row['description']?></td>
        <td><?= $row['date_added']?></td>
        <td><?= $row['is_done'] == 0? 'Не выполнено':'Выполнено'?></td>
        <td><a href="index.php?action=done&id=<?= $row['id']?>">Завершить</a></td>
        <td><a href="index.php?action=del&id=<?= $row['id']?>">Удалить</a></td>
      </tr>
    </tbody>

<?php  
	}
?>
  </table>
</body>
</html>

