</main>
<!-- Fermeture de la balise <main> ouverte dans header.php -->

<?php get_sidebar(); ?>
<!-- get_sidebar() : Charge le fichier sidebar.php si le thème en possède un
     Affiche la barre latérale avec widgets (non utilisée dans Planty d'après le contexte) -->

</div>
<!-- Fermeture du div#container ouvert dans header.php -->

<footer id="footer" role="contentinfo">
	<!-- role="contentinfo" : Attribut ARIA pour identifier le pied de page principal -->
	
	<div class="footer-container">
		<!-- Conteneur pour organiser le contenu du footer -->
		
		<a href="<?php echo esc_url(home_url('/mentions-legales')); ?>" class="footer-link">
			<!-- esc_url() : Fonction de sécurité WordPress qui échappe l'URL
			     home_url() : Génère l'URL complète du site + le chemin spécifié
			     Résultat : https://monsite.com/mentions-legales -->
			Mentions Légales
		</a>
	</div>
</footer>

</div>
<!-- Fermeture du div#wrapper ouvert dans header.php -->

<?php wp_footer(); ?>
<!-- wp_footer() : Hook WordPress essentiel avant la fermeture du </body>
     Charge les scripts JavaScript et permet aux plugins d'injecter du contenu
     OBLIGATOIRE pour le bon fonctionnement de WordPress et des plugins -->

</body>

</html>