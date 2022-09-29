validate
<?php
if (isset($_REQUEST))
{	
	foreach ($_REQUEST as $key => $value) {
		if($key ==='name'){
			//if (!preg_match("/^[a-zA-Z-' ]*$/",$value)) {
			//	echo "Sólo letras (sin acentos) y espacios en blanco permitidos";
			if (!preg_match("/^(?=.{3,18}$)[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/",$value)) {
				echo "Sólo letras y espacios en blanco permitidos entre 3 y 18 caracteres";
				continue;
			}
			else {
				echo $value;
			};
		}
		if($key ==='mail'){
			// echo ' ' .$key . ': ' .$value;
			if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
				echo "Esta dirección de correo (".$value.") NO es válida." ;
				return false;
			}
			else {
				echo $value;
				return true;
			};
		};
	};
}
?>
