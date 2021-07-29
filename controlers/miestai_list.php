<?php

include 'models/miestai.class.php';
$miestaiObj = new miestai();

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

// sukuriame puslapiavimo klasės objektą
include 'models/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $miestaiObj->getMiestaiListCount($id, $searchString, $dateFilterMin, $dateFilterMax, $asc );

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio sutartis
$data = $miestaiObj->getMiestaiList($paging->size, $paging->first, $id, $searchString, $dateFilterMin, $dateFilterMax, $asc );

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
			header("Location: index.php?module={$module}&action=list&id={$id}&searchString={$values['searchString']}"
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
include 'views/miestai_list.tpl.php';

?>