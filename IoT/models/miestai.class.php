<?php
/**
 * Miestų redagavimo klasė
 *
 * 
 */

class miestai {

	private $miestai_lentele = '';
	private $salys_lentele = '';
	
	public function __construct() {
		$this->miestai_lentele = config::DB_PREFIX . 'miestai';
		$this->salys_lentele = config::DB_PREFIX . 'salys';
	}
	
	/**
	 * Miestų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getMiestaiList($limit, $offset, $id, $searchString = "", $dateFilterMin = null, $dateFilterMax = null, $asc = "asc") {
		
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
			$orderString = " ORDER BY `{$this->miestai_lentele}`.Pavadinimas DESC ";
		}
		else {
			$orderString = " ORDER BY `{$this->miestai_lentele}`.Pavadinimas ASC ";
		}
		$query = "  SELECT `{$this->miestai_lentele}`.`Miesto_Id`,
						   `{$this->miestai_lentele}`.`Pavadinimas`,
						   `{$this->miestai_lentele}`.`Plotas`,
						   `{$this->miestai_lentele}`.`Gyventojai`,
                                                   `{$this->miestai_lentele}`.`Pasto_kodas`
					FROM `{$this->miestai_lentele}`
						INNER JOIN `{$this->salys_lentele}` ON `{$this->miestai_lentele}`.`FK_Salies_Id`= `{$this->salys_lentele}`.`Salies_Id`" .
					"WHERE `{$this->miestai_lentele}`.`Pavadinimas` LIKE '%{$searchString}%' AND `{$this->miestai_lentele}`.`Pridejimo_data` BETWEEN '{$dateFilterMin}' AND '{$dateFilterMax}' AND `FK_Salies_Id` = '{$id}' "
					. $orderString . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Miestų skaičiaus radimas
	 * @return type
	 */
	public function getMiestaiListCount($id, $searchString = "", $dateFilterMin = null, $dateFilterMax = null, $asc = "asc") {
		$filterString = "";
		
		if(!isset($dateFilterMax)){
			$dateFilterMax = date("Y-m-d");

		}
		if(!isset($dateFilterMin)){
			$dateFilterMin = "1970-01-01";
		}
		$filterString .= "WHERE `{$this->miestai_lentele}`.`Pavadinimas` LIKE '%{$searchString}%' AND `{$this->miestai_lentele}`.`Pridejimo_data` BETWEEN '{$dateFilterMin}' AND '{$dateFilterMax}' AND `FK_Salies_Id` = '{$id}' ";
		if($asc == "desc") {
			$filterString .= " ORDER BY `{$this->miestai_lentele}`.Pavadinimas DESC ";
		}
		else {
			$filterString .= " ORDER BY `{$this->miestai_lentele}`.Pavadinimas ASC ";
		}
		$query = "  SELECT COUNT(`{$this->miestai_lentele}`.`Miesto_Id`) AS `kiekis`
					FROM `{$this->miestai_lentele}`" .
						"INNER JOIN `{$this->salys_lentele}` ON `{$this->miestai_lentele}`.`FK_Salies_Id`= `{$this->salys_lentele}`.`Salies_Id` " . $filterString;
		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Miesto išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getMiestai($id) {
		$query = "  SELECT *
					FROM `{$this->miestai_lentele}`
					WHERE `{$this->miestai_lentele}`.`Miesto_Id`='{$id}'";
		$data = mysql::select($query);

		return $data[0];
	}
	
	/**
	 * Miesto atnaujinimas
	 * @param type $data
	 */
	public function updateMiestai($data) {
		$query = "  UPDATE `{$this->miestai_lentele}`
					SET    `Pavadinimas`='{$data['Pavadinimas']}',
						   `Plotas`='{$data['Plotas']}',
						   `Gyventojai`='{$data['Gyventojai']}',
						   `Pasto_kodas`='{$data['Pasto_kodas']}',
							`FK_Salies_Id`='{$data['FK_Salies_Id']}'
					WHERE `Miesto_Id`='{$data['Miesto_Id']}'";
		mysql::query($query);
	}
	
	/**
	 * Miesto įrašymas
	 * @param type $data
	 */
	public function insertMiestai($data) {
		$query = "  INSERT INTO `{$this->miestai_lentele}`
								(
									`Pavadinimas`,
									`Plotas`,
									`Gyventojai`,
									`Pasto_kodas`,
									`FK_Salies_Id`
								)
								VALUES
								(
									'{$data['Pavadinimas']}',
									'{$data['Plotas']}',
									'{$data['Gyventojai']}',
									'{$data['Pasto_kodas']}',
									'{$data['FK_Salies_Id']}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Miesto šalinimas
	 * @param type $id
	 */
	public function deleteMiestai($id) {
		$query = "  DELETE FROM `{$this->miestai_lentele}`
					WHERE `Miesto_Id`='{$id}'";
		mysql::query($query);
	}
	
}