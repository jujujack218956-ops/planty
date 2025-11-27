<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;
/* Sécurité WordPress : empêche l'accès direct au fichier PHP
   ABSPATH est une constante WordPress définie uniquement lors du chargement normal
   Si le fichier est appelé directement (hors contexte WordPress), le script s'arrête */


// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:
/* Section générée automatiquement par le plugin Child Theme Configurator
   Ces marqueurs de commentaires permettent au plugin de gérer cette section
   Ne pas modifier manuellement entre BEGIN et END */

if (!function_exists('chld_thm_cfg_locale_css')):
   /* Vérifie si la fonction n'existe pas déjà (évite les conflits)
       Bonne pratique pour les thèmes enfants */

   function chld_thm_cfg_locale_css($uri)
   {
      /* Gère les feuilles de style pour les langues RTL (Right-To-Left)
           RTL = langues qui s'écrivent de droite à gauche (arabe, hébreu, etc.) */

      if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
         /* Conditions :
               - $uri est vide (pas de feuille RTL définie)
               - Le site est en mode RTL
               - Un fichier rtl.css existe dans le thème parent */

         $uri = get_template_directory_uri() . '/rtl.css';
      /* get_template_directory_uri() : URL du thème PARENT
               Charge le fichier rtl.css du thème parent si nécessaire */

      return $uri;
   }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');
/* Hook WordPress : filtre l'URI de la feuille de style locale
   Permet de modifier l'URL de la feuille de style selon les besoins */

if (!function_exists('chld_thm_cfg_parent_css')):
   function chld_thm_cfg_parent_css()
   {
      /* Fonction qui charge la feuille de style du thème parent
           Essentiel pour un thème enfant : hérite des styles du parent */
      wp_enqueue_style('chld_thm_cfg_parent', trailingslashit(get_template_directory_uri()) . 'style.css', array());
      /* wp_enqueue_style() : Met en file d'attente une feuille de style
           Paramètres :
           - 'chld_thm_cfg_parent' : identifiant unique (handle)
           - trailingslashit() : ajoute un "/" à la fin de l'URL si nécessaire
           - get_template_directory_uri() : URL du thème parent (BlankSlate)
           - array() : dépendances (aucune ici) */
   }
endif;
add_action('wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10);
/* Hook WordPress : action déclenchée lors du chargement des scripts/styles
   Paramètres :
   - 'wp_enqueue_scripts' : moment où l'action se déclenche
   - 'chld_thm_cfg_parent_css' : fonction à exécuter
   - 10 : priorité (plus le nombre est bas, plus c'est exécuté tôt) */

// END ENQUEUE PARENT ACTION

// Afficher le lien Admin si l'utilisateur est connecté
function planty_hide_admin_link($items, $args)
{
   /* Fonction personnalisée pour le projet Planty
       But : Afficher le bouton "Admin" uniquement aux utilisateurs connectés
       
       Paramètres reçus automatiquement par le hook :
       - $items : tableau des éléments du menu
       - $args : arguments du menu (contient theme_location, etc.) */

   if ($args->theme_location == 'main-menu') {
      /* Vérifie qu'on modifie bien le menu principal
           Évite de toucher aux autres menus du site (footer, etc.) */

      if (is_user_logged_in()) {
         /* is_user_logged_in() : fonction WordPress qui retourne true/false
               Si l'utilisateur EST connecté, on ne fait rien et on retourne le menu complet*/

         return $items;
         /* Retourne le menu complet avec le lien "Admin" visible
               Le reste du code n'est pas exécuté grâce au return */
      }

      // Si l'utilisateur n'est pas connecté, on arrive jusqu'ici
      //Parcourir les éléments du menu pour retirer "Admin"
      foreach ($items as $key => $item) {
         /* Boucle sur tous les éléments du menu
                   $key : position de l'élément
                   $item : objet contenant les données de l'élément (title, url, etc.) */

         // Supprimer l'élément "Admin"
         if (strtolower($item->title) === 'admin') {
            /* strtolower() : convertit en minuscules pour comparaison insensible à la casse
                       Compare le titre de l'élément avec 'admin'
                       === : comparaison stricte (type ET valeur) */

            unset($items[$key]);
            /* unset() : supprime l'élément du tableau
                       L'élément "Admin" est retiré du menu pour les visiteurs non connectés */
         }
      }
   }
   return $items;
   /* Retourne le tableau des éléments de menu modifié (sans "Admin")
       WordPress utilisera ce tableau pour afficher le menu */
}
add_filter('wp_nav_menu_objects', 'planty_hide_admin_link', 10, 2);
/* Hook WordPress : filtre les objets du menu de navigation
   Paramètres :
   - 'wp_nav_menu_objects' : nom du filtre (s'applique aux menus)
   - 'planty_hide_admin_link' : fonction à exécuter
   - 10 : priorité d'exécution
   - 2 : nombre de paramètres acceptés par la fonction ($items et $args) */