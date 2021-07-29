<?php

include 'models/salys.class.php';
$salysObj = new salys();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Pavadinimas');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Pavadinimas' => 40,
	'Tel_kodas' => 5,
	
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'Pavadinimas' => 'anything',
		'Plotas' => 'positivenumber',
		'Gyventojai' => 'positivenumber',
		'Tel_kodas' => 'positivenumber');

	// sukuriame validatoriaus objektą
	include 'models/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();
		$tmp = $salysObj->getSalys($dataPrepared['Salies_Id']);

		if(isset($tmp['Salies_Id'])) {
			// sudarome klaidų pranešimą
			$formErrors = "Šalis su įvestu numeriu jau egzistuoja.";
			// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
			$data = $_POST;
		} else {
			// įrašome naują sutartį
			$salysObj->insertSalys($dataPrepared);
		}
		if($formErrors == null) {
			header("Location: index.php?module={$module}&action=list&confirm=1");
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
include 'views/salys_form.tpl.php';

?>