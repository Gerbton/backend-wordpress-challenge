<?php

namespace App\Models;

defined( 'ABSPATH' ) || exit;


class Route {

	public static function singular( string $postType, callable $callback ): void {
		add_action(
			'parse_query',
			static function () use ( $postType, $callback ) {
				if ( ! is_singular( $postType ) ) {
					return;
				}

				$callback();
			}
		);
	}
}