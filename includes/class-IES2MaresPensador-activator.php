<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    IES2MaresPensador
 * @subpackage IES2MaresPensador/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    IES2MaresPensador
 * @subpackage IES2MaresPensador/includes
 * @author     Your Name <email@example.com>
 */
class IES2MaresPensador_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        self::create_table();
	}

	private static function create_table() {
        global $wpdb;

        $table_name = $wpdb->prefix . IES2MaresPensador::TABLE_NAME;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
          post_id mediumint(9) NOT NULL,
          nombre varchar(100) NOT NULL,
          time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
          curso varchar(20) NOT NULL,
          solucion text NOT NULL,
          PRIMARY KEY  (post_id, nombre)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

}
