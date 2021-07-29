

<?php
$formErrors = "";
if (!empty($_POST['submit'])) { 
    $filename = $_FILES['myfile']['name'];
	$sql = "LOAD DATA LOCAL INFILE '{$filename}'
		INTO TABLE salys
		FIELDS TERMINATED BY ','
		ENCLOSED BY '\"'
		LINES TERMINATED BY '\n'
		IGNORE 1 LINES
		(Pavadinimas,Plotas,Gyventojai,Tel_kodas,Salies_Id,Pridejimo_data)";
	mysql::query($sql);
}
include 'views/upload.tpl.php';
?>