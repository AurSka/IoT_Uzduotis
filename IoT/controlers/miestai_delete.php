<?php

include 'models/miestai.class.php';
$miestaiObj = new miestai();

if(!empty($id)) {

	
	$FK_Salies_Id = $miestaiObj->getMiestai($id)['FK_Salies_Id'];
	$miestaiObj->deleteMiestai($id);

	// nukreipiame į sutarčių puslapį
	header("Location: index.php?module={$module}&action=list&id={$FK_Salies_Id}&confirm=1");
	die();
}

?>