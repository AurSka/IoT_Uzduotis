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

		// atnaujiname duomenis
		$salysObj->updateSalys($dataPrepared);

		// nukreipiame į markių puslapį
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
} else {
	// išrenkame elemento duomenis ir jais užpildome formos laukus.
	$data = $salysObj->getSalys($id);
}

$data['editing'] = 1;

// įtraukiame šabloną
include 'views/salys_form.tpl.php';

?>