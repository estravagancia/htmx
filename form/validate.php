validate
<?php
if (isset($_REQUEST))
	echo ' ( '.sizeof($_REQUEST).' ) ';

	foreach ($_REQUEST as $key => $value) {
		if($key ==='name'){
			if (!preg_match("/^[a-zA-Z-' ]*$/",$value)) {
				echo "Sólo letras (sin acentos) y espacios en blanco permitidos";
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
?>