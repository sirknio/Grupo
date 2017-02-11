<!DOCTYPE html>
<html>
<title>Grupos Conexión (Application free for any church)</title>
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>

<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-container w3-top w3-black w3-large w3-padding" style="z-index:4">
  <!--<button class="w3-btn w3-hide-large w3-padding-0 w3-hover-text-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>-->
  <span class="w3-right">Logo</span>
</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px;margin-top:80px;">
	<?php echo form_open('login'); ?>
		<table>
			<tr>
				<td><i class="fa fa-user fa-fw"></i>&nbsp;&nbsp;</td>
				<td><input class="form-control" type="text" name="usuario" value="<?= set_value('usuario'); ?>" placeholder="   Usuario" size="25" /></td>
				<td><?
				if(isset($error)){
					echo "<p>".$error."</p>";
				}
				echo form_error('usuario');
				?></td>
			</tr> 
			<tr>
				<td><i class="fa fa-key fa-fw"></i>&nbsp;&nbsp;</td>
				<td><input class="form-control" type="password" name="password" value="<?= set_value('password'); ?>" placeholder="   Contraseña" size="25" /></td>
				<td><?= form_error('password');?></td>
		   </tr>
			<tr>
				<td></td><td></td><td></td>
			</tr> 		
		   <tr>
				<td colspan="3" align=center><button type="submit" class="w3-btn">&nbsp;Ingresar&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in"></i>&nbsp;</button></td>
		   </tr>      
		</table>
	</form>
</div>

</body>
</html>

