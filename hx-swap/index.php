<?php
session_start();
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>X-CSRFToken</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/htmx.org@1.8.0"></script>
</head>
<!-- <body hx-headers='{"X-CSRFToken": "< ?php echo $_SESSION['token'] ?>"}'> -->
<body>

<h3>[<em><a href="https://htmx.estravagancia.com/swapping/" data-type="post" data-id="43">doc</a></em>]<span style="font-size: revert; background-color: var(--global--color-background); color: var(--global--color-foreground); font-family: var(--global--font-secondary);"></span></h3>

<p>htmx ofrece algunas formas diferentes de intercambiar el HTML devuelto al DOM. De forma predeterminada, el contenido reemplaza el HTML interno <strong>innerHTML</strong> del elemento de destino. Puede modificar esto usando el atributo&nbsp;<strong>hx-swap</strong>&nbsp;con cualquiera de los siguientes valores:</p>

<figure class="wp-block-table"><table><tbody><tr><td><strong>Nombre</strong></td><td><strong>Descripción</strong></td></tr><tr><td>innerHTML</td><td>por defecto, pone el contenido dentro del elemento de destino «hx-target»</td></tr><tr><td>outerHTML</td><td>remplaza el elemento de destino por el contenido devuelto</td></tr><tr><td>afterbegin</td><td>antepone el contenido antes del primer hijo en el elemento de destino</td></tr><tr><td>beforebegin</td><td>antepone el contenido antes del objetivo en el elemento padre del destino</td></tr><tr><td>beforeeend</td><td>añade el contenido después del último hijo en el elemento de destino</td></tr><tr><td>afterend</td><td>añade el contenido después del objetivo en el elemento padre del destino</td></tr><tr><td>none</td><td>no agrega contenido de la respuesta Out of Band Swaps y Response Headers aún se procesarán)</td></tr></tbody></table></figure>
    <!-- hx-get="https://v2.jokeapi.dev/joke/Any?format=txt&safe-mode&lang=es" -->
<pre>
&lt;?php
while ($i < 10) {
	if($i>0)
	echo &lt;li&gt;' .$i . '&lt;/li&gt;';
	$i++;
}
?&gt;



    &lt;ol class="jokes" id="result"&gt;
        &lt;li&gt;&lt;/li&gt;
    &lt;/ol&gt;
</pre>


<h2>innerHTML</h2>
<p>por defecto, pone el contenido dentro del elemento de destino «hx-target»</p>

<button
    class="btn"
    hx-get="/tasks/list.php"
    hx-target="#result-inner"
>
Cargar lista
</button>
<ol class="jokes" id="result-inner"><li></li></ol>


<h2>outerHTML</h2>
<p>remplaza el elemento de destino por el contenido devuelto</p>

<button
    class="btn"
    hx-get="/tasks/list.php"
    hx-target="#result-outer"
    hx-swap="outerHTML"
>
Cargar lista
</button>
<ol class="jokes" id="result-outer"><li></li></ol>


<h2>afterbegin</h2>
<p>antepone el contenido antes del primer hijo en el elemento de destino</p>
<button
    class="btn"
    hx-get="/tasks/list.php"
    hx-target="#result-afterbegin"
    hx-swap="afterbegin show:#result-afterbegin:top"
>
     Cargar lista
</button> 
<ol class="jokes" id="result-afterbegin"><li></li></ol>



<h2>beforebegin</h2>
<p>antepone el contenido antes del objetivo en el elemento padre del destino</p>
<button
    class="btn"
    hx-get="/tasks/list.php"
    hx-target="#result-beforebegin"
    hx-swap="beforebegin show:window:top"
>
Cargar lista
</button>
<ol class="jokes" id="result-beforebegin"><li></li></ol>


<h2>beforeend</h2>
<p>añade el contenido después del último hijo en el elemento de destino</p>
<button
    class="btn"
    hx-get="/tasks/list.php"
    hx-target="#result-beforeend"
    hx-swap="beforeend focus-scroll:true"
>
Cargar lista
</button>
<ol class="jokes" id="result-beforeend"><li></li></ol>


<h2>afterend</h2>
<p>añade el contenido después del objetivo en el elemento padre del destino</p>
<button
    class="btn"
    hx-get="/tasks/list.php"
    hx-target="#result-afterend"
    hx-swap="afterend focus-scroll:false"
>
Cargar lista
</button>
<ol class="jokes" id="result-afterend"><li></li></ol>


<h2>none</h2>
<p>no agrega contenido de la respuesta <a href="https://htmx.estravagancia.com/out-of-band-swaps/" data-type="post" data-id="116">Out of Band Swaps</a> y <a href="https://htmx.estravagancia.com/htmx-eventos-especiales/" data-type="page" data-id="90">Response Headers</a> aún se procesarán)</p>
<button
    class="btn"
    hx-get="/tasks/list.php"
    hx-target="#result-none"
    hx-swap="none"
>
Cargar lista
</button>
<ol class="jokes" id="result-none"><li></li></ol>








<!-- <script>
document.body.addEventListener('htmx:configRequest', function(evt) {
    evt.detail.parameters['auth_token'] = <?php echo $_SESSION['token'] ?>; // add a new parameter into the request
    evt.detail.headers['Authentication-Token'] = <?php echo $_SESSION['token'] ?>; // add a new header into the request
    evt.detail.parameters["author"] = "estravagancia"; // add a new parameter into the mix
});
</script> -->
</body>
</html>
