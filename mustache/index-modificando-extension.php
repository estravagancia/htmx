<!-- https://dev.to/marcusatlocalhost/handle-json-api-results-in-htmx-f46 -->
<?php
session_start();
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>X-CSRFToken</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/htmx.org@1.8.0"></script>
    <script src="https://unpkg.com/htmx.org/dist/ext/client-side-templates.js"></script>
</head>
<!-- <body hx-headers='{"X-CSRFToken": "< ?php echo $_SESSION['token'] ?>"}'> -->
<body>

<div hx-ext="client-side-templates">
  <!-- hx-trigger="load, click" makes sure that api gets called on page load AND on click  !-->
  <!-- hx-get="https://api.github.com/users/marcus-at-localhost/gists" -->
  <!-- hx-get="https://v2.jokeapi.dev/joke/Any?format=txt&safe-mode&lang=es" -->
  <button
     type="button"
     hx-trigger="load, click"
     hx-get="https://api.github.com/users/marcus-at-localhost/gists"
     nunjucks-template="gistlist"
     hx-target="#list"
     hx-swap="innerHTML"
  >Reload</button>

  <script id="gistlist" type="twig">
    {% for gist in gists %}
      <li>
        <a href="{{gist.html_url}}">{{gist.parsed.title}}</a><br>
        <small>{{gist.parsed.description}}</small>
      </li>
    {% endfor %}
  </script>

  <ul id="list"></ul>
</div>



<script>
document.body.addEventListener('htmx:configRequest', function(evt) {
    // try to remove x-hx-* headers because gist api complains about CORS
    Object.keys(evt.detail.headers).forEach(function(key) {
      delete evt.detail.headers[key];
    });
  });
  htmx.defineExtension('client-side-templates', {
  transformResponse : function(text, xhr, elt) {
    var nunjucksTemplate = htmx.closest(elt, "[nunjucks-template]");
    if (nunjucksTemplate) {
      // manipulate the json and create my final data object.
      var data = {
        gists: JSON.parse(text).map((item) => {
          // parser : https://codepen.io/localhorst/pen/ZEbqVZd
          item.parsed = new leptonParser().parse(item.description);
          return item;
        })
      };

      var templateName = nunjucksTemplate.getAttribute('nunjucks-template');
      var template = htmx.find('#' + templateName);
      return nunjucks.renderString(template.innerHTML, data);
    }
    return text;
  }
});

</script>
</body>
</html>

