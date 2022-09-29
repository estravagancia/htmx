registration
<?php
if (isset($_REQUEST))
	echo ' ('.sizeof($_REQUEST).') ';
foreach ($_REQUEST as $key => $value) {
    echo ' ' .$key . ': ' .$value;
}
?>