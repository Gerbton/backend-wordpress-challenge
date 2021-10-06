<?php

namespace App\Models;

use App\Controllers\PostTypeController;
use App\Migrations\SubscriptionsTable;
use App\Models\PostType\Label;
use App\Models\PostType\MetaBox;
use App\Models\PostType\PostTypeBuilder;
use App\Models\PostType\PostTypeSettings;

defined( 'ABSPATH' ) || exit;

class FuerzaCursos {
	public static function run( $file ): void {
		self::defineConstants( $file );
		self::registerHooks( $file );
		self::registerPostType();
		self::routes();
	}

	private static function defineConstants( $file ): void {
		define( 'FUERZA_PLUGIN_DIR', plugin_dir_path( $file ) );
		define( 'FUERZA_PLUGIN_URL', plugin_dir_url( $file ) );
		define( 'FUERZA_PLUGIN_VERSION', '0.0.0' );
		define( 'FUERZA_POST_TYPE', 'fuerza-cursos' );
	}

	private static function registerHooks( $file ): void {
		register_activation_hook( $file, [ __CLASS__, 'activate' ] );
		register_deactivation_hook( $file, [ __CLASS__, 'deactivate' ] );
		register_uninstall_hook( $file, [ __CLASS__, 'uninstall' ] );
	}

	public static function activate(): void {
		flush_rewrite_rules();

		$subscriptionsTable = new SubscriptionsTable();
		$subscriptionsTable->create();
	}

	public static function deactivate(): void {
		flush_rewrite_rules();
	}

	public static function uninstall(): void {
		$subscriptionsTable = new SubscriptionsTable();
		$subscriptionsTable->drop();
	}

	private static function registerPostType(): void {
		$postType = new PostTypeSettings(
			FUERZA_POST_TYPE,
			new Label( 'Cursos Fuerza', 'Cursos', 'Curso' ),
			'dashicons-book-alt'
		);
		$postType->setSupports(
			[
				'title',
				'editor',
				'thumbnail',
				'excerpt'
			]
		);

		$postTypeBuilder = new PostTypeBuilder( $postType );
		$postTypeBuilder->init();
		$postTypeBuilder->addThumbColumnInAdminList();

		$postTypeBuilder->addMetaBox(
			new MetaBox(
				$postType->getName(),
				'fuerza_details',
				'Detalhes',
				[ __CLASS__, 'showFields' ],
				'normal',
				'high'
			)
		);

		$postTypeBuilder->onSave( [ PostTypeController::class, 'save' ] );
	}

	public static function showFields( $post ): void {
		include FUERZA_PLUGIN_DIR . "/Views/Admin/fields.php";
	}

	private static function routes(): void {
		Route::singular( FUERZA_POST_TYPE, [ PostTypeController::class, 'singular' ] );
	}
}
