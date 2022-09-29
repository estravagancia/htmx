<h1>hola</h1>
<div id="app">resultados</div>
<?php
echo date('l jS \of F Y h:i:s A');
?>
<script>
    // declarados como var paa poder eliminarlos y que no nos diga que ya se encuentran declaradas las variables: fetchPromise y app
 var i = Date.now();   
 var fetchPromise = fetch(
  "https://mdn.github.io/learning-area/javascript/apis/fetching-data/can-store/products.json"
  );
 var app  = document.querySelector('#app');

  fetchPromise
  .then((response) => {
    if (!response.ok) {
      throw new Error(`HTTP error: ${response.status}`);
    }
    return response.json();
  })
  .then((data) => {
    console.log(data[0].name);
    app.innerHTML = data[0].name + i;
  })
  .catch((error) => {
    console.error(`Could not get products: ${error}`);
  });
  delete fetchPromise;
  delete app;
</script>

<?php
foreach ($_REQUEST as $key => $value) {
    echo 'clave: '.$key . ' valor: ' .$value;
    if($key=='myVal')
        echo ' myVal encontrado';
    if($value=='My Value')
        echo ' My Value encontrado';
}
?>