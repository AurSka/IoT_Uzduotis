<?php
/**
 * Ūkių redagavimo klasė
 *
 * 
 */

class salys {
	
	public function __construct() {
		$this->salys_lentele = config::DB_PREFIX . 'salys';
		$this->miestai_lentele = config::DB_PREFIX . 'miestai';
	}
	
	/**
	 * Ūkio išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getSalys($id) {
		$query = "  SELECT *
					FROM `{$this->salys_lentele}`
					WHERE `Salies_Id`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0];
	}

	/**
	 * Ūkių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getSalysList($limit = null, $offset = null, $searchString = "", $dateFilterMin = null, $dateFilterMax = null, $asc = "asc") {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
                if(!isset($dateFilterMax)){
                    $dateFilterMax = date("Y-m-d");

                }
                if(!isset($dateFilterMin)){
                    $dateFilterMin = "1970-01-01";
                }
		if($asc == "desc") {
			$orderString = " ORDER BY `{$this->salys_lentele}`.Pavadinimas DESC ";
		}
		else {
			$orderString = " ORDER BY `{$this->salys_lentele}`.Pavadinimas ASC ";
		}
		$query = "  SELECT *
					FROM `{$this->salys_lentele}`
					WHERE `{$this->salys_lentele}`.`Pavadinimas` LIKE '%{$searchString}%' AND `{$this->salys_lentele}`.`Pridejimo_data` BETWEEN '{$dateFilterMin}' AND '{$dateFilterMax}'" . $orderString . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Ūkių kiekio radimas
	 * @return type
	 */
	public function getSalysListCount($searchString = "", $dateFilterMin = null, $dateFilterMax = null, $asc = "asc") {

		$filterString = "";
		
		if(!isset($dateFilterMax)){
			$dateFilterMax = date("Y-m-d");

		}
		if(!isset($dateFilterMin)){
			$dateFilterMin = "1970-01-01";
		}
		$filterString .= "WHERE `{$this->salys_lentele}`.`Pavadinimas` LIKE '%{$searchString}%' AND `{$this->salys_lentele}`.`Pridejimo_data` BETWEEN '{$dateFilterMin}' AND '{$dateFilterMax}'";
		if($asc == "desc") {
			$filterString .= " ORDER BY `{$this->salys_lentele}`.Pavadinimas DESC ";
		}
		else {
			$filterString .= " ORDER BY `{$this->salys_lentele}`.Pavadinimas ASC ";
		}
		
		$query = "  SELECT COUNT(`Salies_Id`) as `kiekis`
					FROM `{$this->salys_lentele}`" . $filterString;
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	

	public function searchForSalys($searchString) {

		$query = "  SELECT *
					FROM `{$this->salys_lentele}`
					WHERE Pavadinimas = `%{$searchString}%`" . $limitOffsetString;;
		$data = mysql::select($query);
		
		return $data;
	}
	/**
	 * Ūkio šalinimas
	 * @param type $id
	 */
	public function deleteSalys($id) {
		$query = "  DELETE FROM `{$this->salys_lentele}`
					WHERE `Salies_Id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Ūkio atnaujinimas
	 * @param type $data
	 */
	public function updateSalys($data) {
		$query = "  UPDATE `{$this->salys_lentele}`
					SET    `Pavadinimas`='{$data['Pavadinimas']}',
						   `Plotas`='{$data['Plotas']}',
						   `Gyventojai`='{$data['Gyventojai']}',
						   `Tel_kodas`='{$data['Tel_kodas']}'
					WHERE `Salies_Id`='{$data['Salies_Id']}'";
		mysql::query($query);
	}
	
	/**
	 * Ūkio įrašymas
	 * @param type $data
	 */
	public function insertSalys($data) {
		$query = "  INSERT INTO `{$this->salys_lentele}`
								(
									`Pavadinimas`,
									`Plotas`,
									`Gyventojai`,
									`Tel_kodas`
								) 
								VALUES
								(
									'{$data['Pavadinimas']}',
									'{$data['Plotas']}',
									'{$data['Gyventojai']}',
									'{$data['Tel_kodas']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Pieno modelių kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getMiestaiCountOfSalys($id) {
		$query = "  SELECT COUNT({$this->miestai_lentele}.`Miesto_Id`) AS `kiekis`
					FROM {$this->salys_lentele}
						INNER JOIN {$this->miestai_lentele}
							ON {$this->salys_lentele}.`Salies_Id`={$this->miesyai_lentele}.`FK_Salies_Id`
					WHERE {$this->salys_lentele}.`Salies_Id`='{$id}'";
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	
	
}