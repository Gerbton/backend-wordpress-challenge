<?php

/**
 * Plugin Name: Fuerza Cursos
 * Plugin URI: https://www.wordpress.org/fuerza-cursos
 * Description: Plugin para divulgação de cursos
 * Version: 0.0.0
 * Requires at least: 5.8
 * Author: Gerbton Fonseca
 * Author URI: https://gerbton.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: fuerza-cursos
 * Domain Path: /languages
 */

use App\Models\FuerzaCursos;

defined( 'ABSPATH' ) || exit;

require __DIR__ . "/vendor/autoload.php";

FuerzaCursos::run( __FILE__ );
