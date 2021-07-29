<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Miestai</li>
	<li><?php if(!empty($id)) echo "Miesto redagavimas"; else echo "Naujas miestas"; ?></li>
</ul>
<div class="float-clear"></div>
<div id="formContainer">
	<?php if($formErrors != null) { ?>
		<div class="errorBox">
			Neįvesti arba neteisingai įvesti šie laukai:
			<?php 
				echo $formErrors;
			?>
		</div>
	<?php } ?>
	<form action="" method="post">
		<fieldset>
			
			<legend>Miesto informacija</legend>
			<p>
				<label class="field" for="Pavadinimas">Pavadinimas<?php echo in_array('Pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pavadinimas" name="Pavadinimas" class="textbox textbox-150" value="<?php echo isset($data['Pavadinimas']) ? $data['Pavadinimas'] : ''; ?>">
				<?php if(key_exists('Pavadinimas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Pavadinimas']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="Plotas">Plotas, km^2<?php echo in_array('Plotas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Plotas" name="Plotas" class="textbox textbox-150" value="<?php echo isset($data['Plotas']) ? $data['Plotas'] : ''; ?>">
			</p>
                        <p>
				<label class="field" for="Gyventojai">Gyventojų skaičius, tūkst.<?php echo in_array('Gyventojai', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Gyventojai" name="Gyventojai" class="textbox textbox-150" value="<?php echo isset($data['Gyventojai']) ? $data['Gyventojai'] : ''; ?>">
			</p>
			<p>
				<label class="field" for="Pasto_kodas">Pašto kodas<?php echo in_array('Pasto_kodas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pasto_kodas" name="Pasto_kodas" class="textbox textbox-70" value="<?php echo isset($data['Pasto_kodas']) ? $data['Pasto_kodas'] : ''; ?>"> 
				<?php if(key_exists('Pasto_kodas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Pasto_kodas']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="FK_Salies_Id">Šalis<?php echo in_array('FK_Salies_Id', $required) ? '<span> *</span>' : ''; ?></label>
				<select id="fk_UKISukisId" name="FK_Salies_Id">
					<option value="">---------------</option>
					<?php
						$salys = $salysObj->getSalysList();
						foreach($salys as $key => $val) {
							$selected = "";
							if((isset($data['FK_Salies_Id']) && $data['FK_Salies_Id'] == $val['Salies_Id']) || $_GET['FK_Salies_Id'] == $val['Salies_Id'] ) {
								$selected = " selected='selected'";
							}
							echo "<option{$selected} value='{$val['Salies_Id']}'>{$val['Salies_Id']} {$val['Pavadinimas']}</option>";
						}
					?>
				</select>
			</p>
			<input type="hidden" name="Miesto_Id" value="<?php echo isset($data['Miesto_Id']) ? $data['Miesto_Id'] : ''; ?>"> 
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['id'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
		<?php } ?>
	</form>
</div>