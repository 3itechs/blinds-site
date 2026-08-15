<?php
/**
 * Product category term archive.
 *
 * The Blinds Category design (Figma 2:528) serves every range, so this simply
 * defers to the post type archive template.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require BC_DIR . '/archive-bc_product.php';
