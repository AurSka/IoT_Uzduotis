<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Šalys</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja šalis</a>
</div>
<div class="float-clear"></div>
<?php if(isset($_GET['confirm'])) { 
	echo "<div class=\"warningBox\">
		Veiksmas įvykdydas. 
	</div>";
} ?>
<form action="" method="post">
		<fieldset>
			<p>
				<label class="field" for="searchString">Pavadinimo paieška </label>
				<input type="text" id="searchString" name="searchString" class="textbox textbox-150" value="<?php echo isset($searchString) ? $searchString : ''; ?>">
			</p>
			<p>
				<label class="field" for="dateFilterMin">Nuo</label>
				<input type="text" id="dateFilterMin" name="dateFilterMin" class="textbox textbox-70 date" value="<?php echo isset($dateFilterMin) ? $dateFilterMin : '1970-01-01'; ?>" />
			</p>
			<p>
				<label class="field" for="dateFilterMax">Iki</label>
				<input type="text" id="dateFilterMax" name="dateFilterMax" class="textbox textbox-70 date" value="<?php echo isset($dateFilterMax) ? $dateFilterMax : date("Y-m-d"); ?>" />
			</p>
			<p>
				<label class="field" for="asc">Eiliškumas/label>
				<select id="asc" name="asc">
					<?php
                                                if(!isset($asc) || $asc == "asc") {
                                                    echo "<option selected='selected' value='asc'>A-Ž</option>";
                                                    echo "<option value='desc'>Ž-A</option>";
                                                }
						else{
                                                    echo "<option value='asc'>A-Ž</option>";
                                                    echo "<option selected='selected' value='desc'>Ž-A</option>";
						}
					?>
				</select>
			</p>
		</fieldset>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti filtrą">
		</p>
		<?php if(isset($data['id'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
		<?php } ?>
	</form>
<table class="listTable">
	<tr>
		<th>Pavadinimas</th>
		<th>Plotas, km^2</th>
		<th>Gyventojų skaičius, tūkst.</th>
		<th>Telefono kodas</th>
	</tr>
        
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td><a href='index.php?module=miestai&action=list&id={$val['Salies_Id']}' title=''>{$val['Pavadinimas']}</a></td>"
					. "<td>{$val['Plotas']}</td>"
					. "<td>{$val['Gyventojai']}</td>"
					. "<td>{$val['Tel_kodas']}</td>"
					. "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['Salies_Id']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['Salies_Id']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<div id="pagingLabel">
	Puslapiai:
</div>
<ul id="paging">
	<?php foreach ($paging->data as $key => $value) {
		$activeClass = "";
		if($value['isActive'] == 1) {
			$activeClass = " class='active'";
		}
		echo "<li{$activeClass}><a href='index.php?module={$module}&action=list&page={$value['page']}&searchString={$searchString}"
                . "&dateFilterMin={$dateFilterMin}&dateFilterMax={$dateFilterMax}&asc={$asc}' title=''>{$value['page']}</a></li>";
	} ?>
</ul>