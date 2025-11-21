<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php blankslate_schema_type(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
	<!-- wp_head() : Hook WordPress essentiel qui charge les styles, scripts et meta tags 
	     Permet aux plugins et au thème d'injecter du contenu dans le <head> -->
</head>

<body <?php body_class(); ?>>
	<!-- body_class() : Ajoute automatiquement des classes CSS contextuelles au body 
	     (ex: page-id-5, logged-in, admin-bar, etc.) pour faciliter le ciblage CSS -->

	<?php wp_body_open(); ?>
	<!-- wp_body_open() : Hook WordPress juste après l'ouverture du <body>
	     Permet aux plugins d'injecter du contenu (ex: Google Tag Manager) -->

	<div id="wrapper" class="hfeed">
		<!-- hfeed : Classe microformat pour indiquer que le site contient un flux de contenu -->

		<header id="header" role="banner">
			<!-- role="banner" : Attribut ARIA pour l'accessibilité, identifie l'en-tête principal -->

			<div class="header-container">
				<!-- Conteneur pour organiser le logo et la navigation -->

				<div id="branding">
					<!-- Section dédiée au logo/identité visuelle du site -->
					<?php the_custom_logo(); ?>
					<!-- the_custom_logo() : Affiche le logo configuré dans Apparence > Personnaliser > Identité du site -->
				</div>

				<nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
					<!-- role="navigation" : Attribut ARIA pour identifier la navigation principale
					     itemscope/itemtype : Balisage schema.org pour améliorer le SEO -->

					<?php wp_nav_menu([
						'theme_location' => 'main-menu',  // Emplacement défini dans functions.php
						'container' => false,             // Pas de div englobant supplémentaire
						'menu_class' => 'nav-menu',       // Classe CSS sur l'élément <ul>
						'link_before' => '<span itemprop="name">', // Balise avant le texte du lien (SEO)
						'link_after' => '</span>', // Balise après le texte du lien
					]); ?>
				</nav>
			</div>
		</header>

		<div id="container">
			<!-- Conteneur principal qui englobera tout le contenu des pages -->

			<main id="content" role="main">
				<!-- role="main" : Attribut ARIA pour identifier le contenu principal de la page
			     Cette balise reste ouverte, elle sera fermée dans footer.php -->