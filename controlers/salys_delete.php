<?php

include 'models/salys.class.php';
$salysObj = new salys();

if(!empty($id)) {


	$salysObj->deleteSalys($id);


	// nukreipiame į markių puslapį
	header("Location: index.php?module={$module}&action=list&confirm=1");
	die();
}

?>