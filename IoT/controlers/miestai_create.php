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
	'Pasto_kodas' => 8);
	
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


		$tmp = $miestaiObj->getMiestai($dataPrepared['Miesto_Id']);

		if(isset($tmp['Miesto_Id'])) {
			// sudarome klaidų pranešimą
			$formErrors = "Sutartis su įvestu numeriu jau egzistuoja.";
			// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
			$data = $_POST;
		} else {

			$miestaiObj->insertMiestai($dataPrepared);
		}
		
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
}

// įtraukiame šabloną
include 'views/miestai_form.tpl.php';

?>