<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Šalys</a></li>
	<li><?php if(!empty($id)) echo "Šalies redagavimas"; else echo "Nauja šalis"; ?></li>
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
			
			<legend>Šalies informacija</legend>
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
				<label class="field" for="Tel_kodas">Telefono kodas<?php echo in_array('Tel_kodas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Tel_kodas" name="Tel_kodas" class="textbox textbox-70" value="<?php echo isset($data['Tel_kodas']) ? $data['Tel_kodas'] : ''; ?>"> 
				<?php if(key_exists('Tel_kodas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['Tel_kodas']} simb.)</span>"; ?>
			</p>
			<input type="hidden" name="Salies_Id" value="<?php echo isset($data['Salies_Id']) ? $data['Salies_Id'] : ''; ?>"> 
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['id'])) { ?>
			<input type="text" name="id" value="<?php echo $data['id']; ?>" />
		<?php } ?>
	</form>
</div>