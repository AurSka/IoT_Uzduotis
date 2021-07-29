<div class="float-clear"></div>
<?php

 if($formErrors != null) { ?>
		<div class="errorBox">
			
			<?php 
				echo $formErrors;
			?>
		</div>
	<?php } ?>

<form action="index.php" method="post" >
          <h3>Įkelti failą</h3>
          <input type="file" name="myfile"> <br>
          <button type="submit" class="submit button" name="submit">Įkelti</button>
</form>