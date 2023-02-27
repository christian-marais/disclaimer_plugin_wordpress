<?php

/*
Plugin Name: eu_disclaimer_finale!
Plugin URI: 
Description: Un plugin de disclaimer
Author: Christian Marais
Version: 1.0.0
*/


add_action('wp_head', 'disclaimer_launch');
add_action('wp_footer','disclaimer_texte');
add_action('init', 'ajoutdushortcode');
add_action('admin_menu','add_disclaimer_menu_page');


function disclaimer_launch(){
  echo'
<!-- christian asset ------------------------------------------->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="'.plugins_url( "/assets/css/style.css" , __FILE__ ).'">
  <!-- JavaScript Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
';
}
function disclaimer_texte(){
  
  echo DisclaimerGestionTable::afficherDonneModal();
  echo '<script src="'.plugins_url( "/assets/Js/eu-disclaimer.js" , __FILE__ ).'"></script>';
}
function ajoutdushortcode(){
    add_shortcode('ajoutdisclaimer','ajout');
}
function ajout(){
  echo'

  ';
}
function add_disclaimer_menu_page(){//fonction pour le gestion du meny back-end
  
        $page='disclaimerEurope';
        $menu='eu-disclaimer';
        $capability='manage_options';
        $slug='plugin_dir_path(__FILE__).eu-disclaimer.php' ;
        $function='generer_menu';
        $icon='';
        $position=80;
        if(is_admin()){
          add_menu_page($page,$menu,$capability,$slug,$function,$icon,$position);
        }
}
function generer_Menu(){
  require_once('inc/disclaimer-menu.php');
}

require_once(dirname(__FILE__).'/Model/repository/DisclaimerGestionTable.php');

if (class_exists('DisclaimerGestionTable')){
  $gerer_table = new DisclaimerGestionTable();
}
if (isset($gerer_table)){
  register_activation_hook(__FILE__, array($gerer_table,'creerTable'));
  register_deactivation_hook(__FILE__,array($gerer_table,'supprimerTable'));
}
?>