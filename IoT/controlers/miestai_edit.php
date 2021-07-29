<?php

include 'models/miestai.class.php';
$miestaiObj = new miestai();

include 'models/salys.class.php';
$salysObj = new salys();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Pavadinimas');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Pavadinimas' => 40,
	'Pasto_Id' => 8);
	
// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	include 'models/validator.class.php';

	// nustatome laukų validatorių tipus
	$validations = array (
		'Pavadinimas' => 'anything',
		'Plotas' => 'positivenumber',
		'Gyventojai' => 'positivenumber',
		'Pasto_kodas' => 'anything',
		'FK_Salies_Id' => 'positivenumber');

	// sukuriame laukų validatoriaus objektą
	$validator = new validator($validations, $required);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		$miestaiObj->updateMiestai($dataPrepared);

		// nukreipiame vartotoją į sutarčių puslapį
		if($formErrors == null) {
			header("Location: index.php?module={$module}&action=list&id={$dataPrepared['FK_Salies_Id']}&confirm=1");
			die();
		}
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
	}
} else {
	//  išrenkame elemento duomenis ir jais užpildome formos laukus.
	$data = $miestaiObj->getMiestai($id);
}

// nustatome požymį, kad įrašas redaguojamas norint išjungti ID redagavimą šablone
$data['editing'] = 1;

// įtraukiame šabloną
include 'views/miestai_form.tpl.php';

?>