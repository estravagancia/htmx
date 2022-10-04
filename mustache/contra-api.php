{# https://randomuser.me/api/ #}

<?php
session_start();
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>randomuser API</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/htmx.org@1.8.0"></script>
    <script src="https://unpkg.com/htmx.org/dist/ext/client-side-templates.js"></script>
    <script src="https://unpkg.com/mustache@latest"></script>
</head>
<body>
<div hx-ext="client-side-templates">
    <button
        type="button"
        hx-trigger="click"
        hx-get="https://randomuser.me/api/"
        mustache-template="randomuser"
        hx-target="#randomuserLi"
        hx-swap="innerHTML"
    >load
    </button>

</div>
<div id="randomuserLi"></div>

<script id="randomuser" type="mustache">
    {{#results}}
        <p>
            <small>{{name.title}}</small>
            {{name.first}}
            {{name.last}}
        </p>
        <img src="{{picture.large}}" alt="{{gender}}" title="from {{location.country}}" />
    {{/results}}
</script>



<!--
{"results":[
    {
    "gender":"female",
    "name":{"title":"Mrs","first":"Brielle","last":"Harcourt"},
    "location":{
        "street":{"number":7336,"name":"Stanley Way"},
        "city":"Odessa",
        "state":"Nova Scotia",
        "country":"Canada",
        "postcode":"F8U 9M6",
        "coordinates":{"latitude":"-66.4557","longitude":"27.5297"},
        "timezone":{"offset":"+2:00","description":"Kaliningrad, South Africa"}
    },
    "email":"brielle.harcourt@example.com",
    "login":{
        "uuid":"3668bea8-85fe-4767-bf19-d6f12fcbdaa6",
        "username":"organicswan448",
        "password":"babies",
        "salt":"w05BABB0",
        "md5":"5e42ac229a69efcb656f6ac5699d6bee",
        "sha1":"a740c937005ffeeea275134cf1261e5301320591",
        "sha256":"39b34e7dccebbabccd9bc959c3a6b11232752c6c890acf19a60d8edd838fd9ad"
    },
    "dob":{
        "date":"1999-10-11T20:54:23.269Z",
        "age":22
    },
    "registered":{
        "date":"2004-02-19T19:48:50.208Z",
        "age":18
    },
    "phone":"Z86 W66-4436",
    "cell":"C19 N73-9790",
    "id":{
        "name":"SIN",
        "value":"530397181"
    },
    "picture":{
        "large":"https://randomuser.me/api/portraits/women/17.jpg",
        "medium":"https://randomuser.me/api/portraits/med/women/17.jpg",
        "thumbnail":"https://randomuser.me/api/portraits/thumb/women/17.jpg"},
        "nat":"CA"
    }
    ],
    "info":{
        "seed":"bdc7cefb2ca92520",
        "results":1,
        "page":1,
        "version":"1.4"
    }
}
-->
<script>
document.body.addEventListener('htmx:configRequest', function(evt) {
  // try to remove x-hx-* headers because gist api complains about CORS
  Object.keys(evt.detail.headers).forEach(function(key) {
    delete evt.detail.headers[key];
  });
});
// fetch('https://randomuser.me/api/')
//   .then((response) => response.json())
//   .then((data) => console.log(data));
//   return response;

/*
!async function(){
    let data = await fetch("https://randomuser.me/api/")
        .then((response) => response.json())
        .then(data => {
            return data;
        })
        .catch(error => {
            console.error(error);
        });
        console.log(data);
    const imagen = `<img src="${data.results[0].picture.large}" alt=""/>`;
    console.log(imagen);
    const titulo = data.results[0].name.title;
    const nombre = data.results[0].name.first;
    const apellidos = data.results[0].name.last;
    console.log(titulo + ' ' + nombre + ' '+ apellidos);
    console.log('from '+ data.results[0].location.country);
}();
*/
</script>
</body>
</html>