<?php

namespace App\Models;

use App\Models\PostType\Label;
use App\Models\PostType\PostTypeBuilder;
use App\Models\PostType\PostTypeSettings;

defined( 'ABSPATH' ) || exit;

class FuerzaCursos {
	public static function run( $file ): void {
		self::registerHooks( $file );
		self::registerPostType();
	}

	private static function registerHooks( $file ): void {
		register_activation_hook( $file, [ __CLASS__, 'activate' ] );
		register_deactivation_hook( $file, [ __CLASS__, 'deactivate' ] );
		register_uninstall_hook( $file, [ __CLASS__, 'uninstall' ] );
	}

	public static function activate(): void {
		flush_rewrite_rules();
	}

	public static function deactivate(): void {
		flush_rewrite_rules();
	}

	public static function uninstall(): void {

	}

	private static function registerPostType(): void {
		$postType = new PostTypeSettings(
			'fuerza-cursos',
			new Label( 'Cursos Fuerza', 'Cursos', 'Curso' ),
			'dashicons-book-alt'
		);

		$postTypeBuilder = new PostTypeBuilder( $postType );
		$postTypeBuilder->init();
		$postTypeBuilder->addThumbColumnInAdminList();
	}
}
