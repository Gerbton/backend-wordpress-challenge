<?php

namespace App\Models\PostType;

defined( 'ABSPATH' ) || exit;

class PostTypeBuilder {
	protected PostTypeSettings $postTypeSettings;

	public function __construct( PostTypeSettings $postTypeSettings ) {
		$this->postTypeSettings = $postTypeSettings;
	}

	public function init(): void {
		add_action( 'init', [ $this, 'register' ] );
	}

	public function register(): void {
		$label    = $this->postTypeSettings->getLabel();
		$postType = $this->postTypeSettings->getName();

		$args = [
			'description'       => $this->postTypeSettings->getDescription(),
			'labels'            => [
				'name'               => __( $label->getName(), $postType ),
				'singular_name'      => __( $label->getSingular(), $postType ),
				'add_new'            => _x( 'Adicionar ', $postType ),
				'all_items'          => _x( 'Ver Tudo', $postType ),
				'add_new_item'       => _x( 'Adicionar ' . $label->getSingular(), $postType ),
				'edit_item'          => _x( 'Editar ' . $label->getSingular(), $postType ),
				'new_item'           => _x( 'Novo ' . $label->getSingular(), $postType ),
				'view_item'          => _x( 'Ver ' . $label->getPlural(), $postType ),
				'search_items'       => _x( 'Procurar ' . $label->getSingular(), $postType ),
				'not_found'          => _x( 'Não existem ' . $label->getPlural(), $postType ),
				'not_found_in_trash' => _x( 'Nenhum ' . $label->getSingular() . ' encontrado na lixeira', $postType ),
				'menu_name'          => _x( $label->getPlural(), $postType )
			],
			'public'            => $this->postTypeSettings->isPublic(),
			'hierarchical'      => $this->postTypeSettings->isHierarchical(),
			'has_archive'       => $this->postTypeSettings->hasArchive(),
			'menu_icon'         => $this->postTypeSettings->getIcon(),
			'supports'          => $this->postTypeSettings->getSupports(),
			'rewrite'           => $this->postTypeSettings->getRewrite(),
			'taxonomies'        => $this->postTypeSettings->getTaxonomies(),
			'show_ui'           => $this->postTypeSettings->isShowUI(),
			'menu_position'     => $this->postTypeSettings->getMenuPosition(),
			'show_in_admin_bar' => $this->postTypeSettings->isShowInAdminBar(),
			'show_in_nav_menus' => $this->postTypeSettings->isShowInNavMenus(),
			'show_in_rest'      => $this->postTypeSettings->isShowInRest(),
			'can_export'        => $this->postTypeSettings->canExport()
		];

		register_post_type( $postType, $args );
	}

	public function addThumbColumnInAdminList(): void {
		$postType = $this->postTypeSettings->getName();

		add_filter( "manage_{$postType}_posts_columns", [ $this, 'addThumbnailTitleInAdminList' ], 1 );
		add_filter( "manage_{$postType}_posts_custom_column", [ $this, 'showThumbnailInAdminList' ], 1, 1 );
	}

	public function addThumbnailTitleInAdminList( array $columns ): array {
		$columns['thumbnail'] = 'Imagem';

		return $columns;
	}

	public function showThumbnailInAdminList( string $column ): void {
		if ( 'thumbnail' !== $column ) {
			return;
		}

		the_post_thumbnail( [ 100, 100 ] );
	}

	public function addMetaBox( MetaBox $metaBox ): void {
		add_action( "add_meta_boxes_{$this->postTypeSettings->getName()}", function () use ( $metaBox ) {
			$metaBox->register();
		} );
	}
}
