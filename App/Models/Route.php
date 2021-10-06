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

	public static function post( string $route, callable $callback ): void {
		add_action( 'rest_api_init', static function () use ( $route, $callback ) {
			self::register( \WP_REST_Server::CREATABLE, $route, $callback );
		} );
	}

	private static function register( string $method, string $route, callable $callback ): void {
		register_rest_route(
			FUERZA_POST_TYPE . '/v1',
			$route,
			[
				'methods'             => $method,
				'callback'            => $callback,
				'permission_callback' => '__return_true'
			]
		);
	}
}