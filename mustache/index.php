
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
    <script src="https://unpkg.com/mustache@latest"></script>
  </head>
  <!-- <body hx-headers='{"X-CSRFToken": "< ?php echo $_SESSION['token'] ?>"}'> -->
    <body>
    <div hx-ext="client-side-templates">
      <button hx-get="https://v2.jokeapi.dev/joke/Any?format=json&safe-mode" 
          mustache-template="my-mustache-template"
          hx-target="#salida"
      >
      Handle with mustache
      </button>
    </div>
    
    <div id="salida"></div>

    <script id="my-mustache-template" type="mustache">
    {{type}}
    {{category}}
      <br/>
    {{% if type == twopart %}}
      <b>{{setup}}</b>
      <br/>
      {{delivery}}
    {{% else %}}
      {{joke}}
    {{% endif %}}
    </script>















    <div hx-ext="client-side-templates">
        <!-- hx-trigger="load, click" makes sure that api gets called on page load AND on click  !-->
        <!-- hx-get="https://api.github.com/users/marcus-at-localhost/gists" -->
        <!-- hx-get="https://v2.jokeapi.dev/joke/Any?format=txt&safe-mode&lang=es" -->
  <button
  type="button"
  hx-trigger="click"
  hx-get="https://api.github.com/users/marcus-at-localhost/gists"
  mustache-template="gistlist"
  hx-target="#list"
  hx-swap="innerHTML"
  >Reload</button>
<script id="gistlist" type="mustache">
  {% for gist in gists %}
    <li>
      <a href="{{gist.html_url}}">{{gist.parsed.title}}</a><br>
      <small>{{gist.parsed.description}}</small>
    </li>
  {% else %}
      No users have been found.
  {% endfor %}
</script>

<ul id="list"></ul>
</div>



<div hx-ext="client-side-templates">

  <button hx-get="https://www.boredapi.com/api/activity" 
      mustache-template="activity"
      hx-target="#salida"
      hx-vals='{"participants": "1"}'
  >
  some plan?
  </button>

</div>

<div id="salida"></div>
<script id="activity" type="mustache">
{{type}}<br/>
{{activity}}
</script>

<script>
document.body.addEventListener('htmx:configRequest', function(evt) {
  // try to remove x-hx-* headers because gist api complains about CORS
  Object.keys(evt.detail.headers).forEach(function(key) {
    delete evt.detail.headers[key];
  });
});
htmx.defineExtension('client-side-templates', {
  transformResponse : function(text, xhr, elt) {
    var mustacheTemplate = htmx.closest(elt, "[mustache-template]");
    if (mustacheTemplate) {
      // manipulate the json and create my final data object.
      var data = {
        gists: JSON.parse(text).map((item) => {
          // parser : https://codepen.io/localhorst/pen/ZEbqVZd
          // item.parsed = new leptonParser().parse(item.description);
          return item;
        })
      };

      var templateName = mustacheTemplate.getAttribute('mustache-template');
      var template = htmx.find('#' + templateName);
      return mustache.renderString(template.innerHTML, data);
    }
    return text;
  }
});



// borrowed from Lepton
// @link https://github.com/hackjutsu/Lepton/blob/0e6d75047c/app/utilities/parser/index.js

class leptonParser {
  //constructor
  constructor(payload='') {
    this.payload = payload;
  }

  parse(payload){
    this.payload = payload || 'No description';
    return this.descriptionParser(payload);
  }

  descriptionParser (payload) {
    const rawDescription = payload;
    const regexForTitle = rawDescription.match(/\[.*\]/);
    const rawTitle = (regexForTitle && regexForTitle[0]) || '';
    const title = ((rawTitle.length > 0) && rawTitle.substring(1, regexForTitle[0].length - 1)) || rawDescription;

    let tagStyle = 'legacy';
    let customTags = this.parseCustomTagsLegacy(rawDescription);
    if (customTags.length === 0) {
      customTags = this.parseCustomTagsTwitter(rawDescription);
      tagStyle = customTags.length > 0 ? 'twitter' : 'legacy';
    }

    const descriptionLength = tagStyle === 'legacy'
    ? rawDescription.length - customTags.length
    : rawDescription.length;
    const description = rawDescription.substring(rawTitle.length, descriptionLength);

    return { title, description, customTags };
  }

  parseCustomTagsLegacy (payload) {
    const regextForCustomTags = payload.match(/#tags:.*$/);
    const customTags = (regextForCustomTags && regextForCustomTags[0]) || '';
    return customTags;
  }

  // http://geekcoder.org/js-extract-hashtags-from-text/
  parseCustomTagsTwitter (payload) {
    var regex = /(?:^|\s)(?:#)([a-zA-Z\d]+)/gm;
    var matches = [];
    var match;

    while ((match = regex.exec(payload))) {
        matches.push(match[1]);
    }
    
    if(!matches.length){
      return '';
    }

    return matches.reduce((acc, cur) => acc + ', ' + cur);
  }
}

console.log(new leptonParser().parse('[bla] #blub #foo and #bar'));
</script>
</body>
</html>

