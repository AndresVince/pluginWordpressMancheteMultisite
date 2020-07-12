<?php
/*
Plugin Name: Manchete Multisites
Description: Seleciona posts de uma categoria atráves dos subsites e retorna o(s) mais recente(s).
Author: Andres Vince
*/
defined( 'ABSPATH' ) or die( 'Crianças, não brinquem com script!' );

// ABSPATH faz papel de> plugin_dir_path (_ FILE_);
//$catcapa = array(99,54,9,9);
require_once plugin_dir_path(__FILE__) . 'inclusoes/manchete-multisites-funcoes.php';
require_once plugin_dir_path(__FILE__) . 'manchete-multisites-widget.php';
// Busca através dos subsites//
//chamamanchete( array(99,54,9,9));
