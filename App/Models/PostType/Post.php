<?php

namespace App\Models\PostType;

defined( 'ABSPATH' ) || exit;

class Post {
	private int $ID;
	private string $title;
	private string $content;
	private string $excerpt;
	private string $link;
	private string $workload;
	private string $deadline;
	private int $thumbnailID;

	public function __construct( \WP_Post $post ) {
		$this->ID          = $post->ID;
		$this->title       = $post->post_title;
		$this->content     = apply_filters( 'the_content', $post->post_content );
		$this->excerpt     = apply_filters( 'the_excerpt', $post->post_excerpt );
		$this->link        = get_post_meta( $post->ID, 'fc_link', true ) ?? '';
		$this->workload    = get_post_meta( $post->ID, 'fc_workload', true ) ?? '';
		$this->deadline    = get_post_meta( $post->ID, 'fc_deadline', true ) ?? '';
		$this->thumbnailID = get_post_thumbnail_id( $post ) ?? 0;
	}

	public function getID(): int {
		return $this->ID;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function getContent(): mixed {
		return $this->content;
	}

	public function getExcerpt(): mixed {
		return $this->excerpt;
	}

	public function getLink(): mixed {
		return $this->link;
	}

	public function getWorkload(): mixed {
		return $this->workload;
	}

	public function getDeadline(): mixed {
		return ( new \DateTime( $this->deadline ?? 'now' ) )->format( 'd/m/Y' );
	}

	public function getThumbnailID(): bool|int {
		return $this->thumbnailID;
	}

	public function isOpenToSubscribe(): bool {
		$today    = new \DateTime();
		$deadline = new \DateTime( $this->deadline );

		return $deadline >= $today;
	}

	public function hasLink(): bool {
		return ! empty( $this->link );
	}
}