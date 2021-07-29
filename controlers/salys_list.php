<?php

// sukuriame markių klasės objektą
include 'models/salys.class.php';
$salysObj = new salys();

//Įrašome visus filtro duomenis
$searchString = "";
if (isset($_GET['searchString'])){
$searchString = $_GET['searchString'];
}

$dateFilterMin = "1970-01-01";
if (isset($_GET['dateFilterMin'])){
$dateFilterMin = $_GET['dateFilterMin'];
}

$dateFilterMax = date("Y-m-d");
if (isset($_GET['dateFilterMax'])){
$dateFilterMax = $_GET['dateFilterMax'];
}

$asc = "asc";
if (isset($_GET['asc'])){
$asc = $_GET['asc'];
}

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $salysObj->getSalysListCount($searchString, $dateFilterMin, $dateFilterMax, $asc );

// sukuriame puslapiavimo klasės objektą
include 'models/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio markes
$data = $salysObj->getSalysList($paging->size, $paging->first, $searchString, $dateFilterMin, $dateFilterMax, $asc );

if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'searchString' => 'anything',
		'dateFilterMin' => 'date',
		'dateFilterMax' => 'date',
		'asc' => 'anything');

	// sukuriame validatoriaus objektą
	include 'models/validator.class.php';
	$validator = new validator($validations);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
			$values = $validator->preparePostFieldsForSQL();

		if($formErrors == null) {
			header("Location: index.php?module={$module}&action=list&searchString={$values['searchString']}"
                . "&dateFilterMin={$values['dateFilterMin']}&dateFilterMax={$values['dateFilterMax']}&asc={$values['asc']}&confirm=1");
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
include 'views/salys_list.tpl.php';

?>