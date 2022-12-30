<?php
include('verifica_login.php');
?>

<h2>Olá, <?php echo $_SESSION['usuario'];?></h2>
<a href="logout.php">Sair<a></a>

<!doctype html>
<html amp lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Syspec - Sistema para Pecuária</title>
    <link rel="canonical" href="https://html5-templates.com/demo/amp/">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
	<script type="application/ld+json">
	{
	"@context": "http://schema.org",
	"@type": "Webpage",
	"url": "https://html5-templates.com",
	"name": "HTML5 Templates",
	"headline": "Simple AMP HTML5 Template",
	"description": "A simple AMP HTML5 template with sidebar, social share icons and some demo text.",
	"author": "html5author",
	"mainEntityOfPage": {
	  "@type": "WebPage",
	  "@id": "https://html5-templates.com"
	},
	"publisher": {
	  "@type": "Organization",
	  "name": "HTML5 Templates",
	  "logo": {
		  "url": "https://html5-templates.com/images/google-amp.jpg",
		  "width": 300,
		  "height": 200,
		  "@type": "ImageObject"
	  }
	},
	"image": {
	  "@type": "ImageObject",
	  "url": "https://html5-templates.com/images/og.jpg",
	  "width": 1000,
	  "height": 458
	}
	}
	</script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<style amp-custom>
body{background-color: #FFFFFF;font-family: Arial, Helvetica, sans-serif;padding: 40px 0 50px;}
#socialFooter{position:fixed;background: #DDD;bottom: 0;left:0;right:0;padding: 5px 10px 0;text-align:center;z-index:1000;height: 35px;}
.wrapFB {vertical-align: middle;padding: 4px 9px 0 4px;float: right;}
#pageWrap {max-width: 500px;margin: auto;padding: 20px;}
.hamburger {padding: 5px 10px 5px 20px;display: inline-block;font-size: 25px;cursor: pointer;}
.site-name {display: inline-block;vertical-align: top;font-size: 20px;font-weight: bold;line-height: 45px;}
.sidebar {padding: 10px;margin: 0;color: #FFF;font-weight:bold;}
#sidebar1{background: #CE5937;}
.sidebar > li {list-style: none;margin-bottom:10px;}
.sidebar a {text-decoration: none;color: #FFF;}
.close-sidebar {font-size: 1.5em;padding: 5px 15px;cursor: pointer;color: #FFFFFF;}
.headerbar {background: #CE5937;color: #FFF;line-height: 30px;position: fixed;top: 0;left: 0;right: 0;height: 40px;z-index: 1000;}
.headerbar a {text-decoration: none;color: #FFF;}
	</style>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
    <script async custom-element="amp-facebook-like" src="https://cdn.ampproject.org/v0/amp-facebook-like-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
  </head>
  <body>
    <header class="headerbar">
      <div role="button" on="tap:sidebar1.toggle" tabindex="0" class="hamburger">☰</div>
      <a href="painel.php">Sistema para Pecuária</a>
    </header>
    <amp-sidebar id="sidebar1" layout="nodisplay" side="left">
      <div role="button" aria-label="close sidebar" on="tap:sidebar1.toggle" tabindex="0" class="close-sidebar">✕</div>
      <ul class="sidebar">
        <li><a href="cadastro_animais.html">Cadastro de animais</a></li>
        <li><a href="pesagem.html">Pesagens</a></li>
        <li><a href="inseminacoes.html">Inseminações</a></li>
        <li><a href="sanitario.html">Sanitário</a></li>
        <li><a href="consultas.html">Consultas</a></li>
        <ul>
                  <li><a href="consulta_animal.html">Consulta Animal</a></li>
                  <li><a href="consulta_partos.html">Consulta Partos</a></li>
                  <li><a href="consulta_partos_atrasados.html">Consulta Partos Atrasados</a></li>
                  <li><a href="consulta_desmamas.html">Consulta Desmamas</a></li>
                  <li><a href="consulta_inseminacoes.html">Consulta Inseminações</a></li>
        
        </ul>
        <li><a href="usuario.html">Usuário</a></li>
        <li><a href="ajuda.html">Ajuda</a></li>
      </ul>
    </amp-sidebar>
    <style type="text/css">
    	#container-da-imagem {
    width: 300px;
    position: relative;
}

#container-da-imagem img {
    width: 100%
}

img {
    width: 100%
}
      .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 20px 20px;
        cursor: pointer;
      }

      .button1 {border-radius: 12px;}
    </style>
	<div id="pageWrap">
		<a> <amp-img src="image/logo.png" width="120" height="120" layout="responsive" alt="cube"></amp-img></a>    
	</div>

  </body>
</html>