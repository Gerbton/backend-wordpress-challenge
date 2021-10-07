<?php

namespace App\Migrations;

use App\Interfaces\Table;

defined( 'ABSPATH' ) || exit;

class SubscriptionsTable implements Table {
	public const OPTION_KEY = 'fuerza_subscriptions_db_version';
	public const VERSION = '0.0.0';
	private string $tableName;
	private \wpdb $wpdb;

	public function __construct() {
		global $wpdb;

		$this->wpdb      = $wpdb;
		$this->tableName = "{$wpdb->prefix}fuerza_subscriptions";

		require_once ABSPATH . "wp-admin/includes/upgrade.php";
	}

	public function create(): void {
		$currentTableVersion = get_option( $this::OPTION_KEY );

		if ( $currentTableVersion ) {
			return;
		}

		$sql = "
			CREATE TABLE $this->tableName (
			    id BIGINT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			    name VARCHAR(50) NOT NULL,
			    email VARCHAR(50) NOT NULL UNIQUE,
			    post_id BIGINT(20) UNSIGNED NOT NULL,
			    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			    INDEX(post_id),
			    FOREIGN KEY (`post_id`) REFERENCES {$this->wpdb->prefix}posts(`ID`)
			                   ON DELETE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8
		";

		dbDelta( $sql );
		add_option( $this::OPTION_KEY, $this::VERSION );
	}

	public function drop(): void {
		$currentTableVersion = get_option( $this::OPTION_KEY );

		if ( ! $currentTableVersion ) {
			return;
		}

		$sql = "DROP TABLE IF EXISTS $this->tableName";

		dbDelta( $sql );
		delete_option( $this::OPTION_KEY );
	}
}