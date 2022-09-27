<h1>hola</h1>
<div id="app">resultados</div>
<?php
echo date('l jS \of F Y h:i:s A');
?>
<script>
    // document.write('adios');
    const fetchPromise = fetch(
  "https://mdn.github.io/learning-area/javascript/apis/fetching-data/can-store/products.json"
  );
  const app  = document.querySelector('#app');

fetchPromise
  .then((response) => {
    if (!response.ok) {
      throw new Error(`HTTP error: ${response.status}`);
    }
    return response.json();
  })
  .then((data) => {
    // console.log(data[0].name);
    app.innerHTML = data[0].name;
  })
  .catch((error) => {
    console.error(`Could not get products: ${error}`);
  });

</script>