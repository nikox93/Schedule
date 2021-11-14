<?
	include 'db_connect.php';
	$id_delete = $_GET['id']; 
	$query = "DELETE FROM rasp WHERE id_w = $id_delete";
	$sql = mysql_query($query,$dp);
	
	echo "<script>alert('Запись № $id_delete успешно удалена из БД. Нажмите ОК для продолжения'); 					
	location.href='http://localhost/admin/';</script>";
?>