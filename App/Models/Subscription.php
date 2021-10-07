<?php

namespace App\Models;

defined('ABSPATH') || exit;

class Subscription {
	private static string $table = 'fuerza_subscriptions';
	private ?int $id;
	private ?string $name;
	private ?string $email;
	private ?int $postId;
	private ?\DateTime $createdAt;

	public function __construct( int $id = null, string $name = null, string $email = null, int $postId = null, string $createdAt = null ) {
		$this->id        = $id;
		$this->name      = $name;
		$this->email     = $email;
		$this->postId    = $postId;
		$this->createdAt = new \DateTime( $createdAt ?? '0000-00-00' );
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function setId( int $id ): void {
		$this->id = $id;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName( string $name ): void {
		$this->name = $name;
	}

	public function getEmail(): ?string {
		return $this->email;
	}

	public function setEmail( string $email ): void {
		$this->email = $email;
	}

	public function getPostId(): ?int {
		return $this->postId;
	}

	public function setPostId( int $postId ): void {
		$this->postId = $postId;
	}

	public function getCreatedAt(): \DateTime {
		return $this->createdAt;
	}

	public function save() {
		global $wpdb;
		$wpdb->fuerza_subscriptions = $wpdb->prefix . $this::$table;

		if ( ! $this->id ) {
			return $this->insert( $wpdb );
		}

		return $this->update( $wpdb );
	}

	private function insert( \wpdb $wpdb ): bool|int {
		$result = $wpdb->insert(
			$wpdb->fuerza_subscriptions,
			[
				'name'    => $this->name,
				'email'   => $this->email,
				'post_id' => $this->postId
			],
			[ '%s', '%s', '%d' ]
		);

		if ( $result ) {
			$this->id = $result;
		}

		return $result;
	}

	private function update( \wpdb $wpdb ): bool|int {
		return $wpdb->update(
			$wpdb->fuerza_subscriptions,
			[
				'name'    => $this->name,
				'email'   => $this->email,
				'post_id' => $this->postId
			],
			[
				'id' => $this->id
			],
			[ '%s', '%s', '%d' ],
			[ '%d' ]
		);
	}

	public static function emailExists( string $email ): bool {
		global $wpdb;

		$table = self::getTableName( $wpdb );

		$query = $wpdb->prepare(
			"SELECT * FROM $table WHERE email = %s",
			$email
		);

		return ! empty( $wpdb->get_row( $query ) );
	}

	public static function findByPostID( int $postId ): array {
		global $wpdb;

		$table = self::getTableName( $wpdb );

		$query = $wpdb->prepare( "SELECT * FROM $table WHERE post_id = %d", $postId );

		$results       = $wpdb->get_results( $query );
		$subscriptions = [];

		foreach ( $results as $result ) {
			$subscriptions[] = new Subscription(
				$result->id,
				$result->name,
				$result->email,
				$result->post_id,
				$result->created_at
			);
		}

		return $subscriptions;
	}

	private static function getTableName( \wpdb $wpdb ): string {
		return $wpdb->prefix . self::$table;
	}
}