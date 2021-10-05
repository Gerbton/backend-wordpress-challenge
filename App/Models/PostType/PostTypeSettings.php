<?php

namespace App\Models\PostType;

defined( 'ABSPATH' ) || exit;

class PostTypeSettings {
	private string $name;
	private Label $label;
	private string $icon;
	private string $description;
	private array $supports;
	private array $rewrite;
	private array $taxonomies;
	private bool $public;
	private bool $showUI;
	private bool $showInMenu;
	private bool $showInAdminBar;
	private bool $showInNavMenus;
	private bool $showInRest;
	private bool $canExport;
	private bool $hierarchical;
	private bool $hasArchive;
	private int $menuPosition;

	public function __construct( string $name, Label $label, string $icon ) {
		$this->name           = $name;
		$this->label          = $label;
		$this->icon           = $icon;
		$this->description    = '';
		$this->supports       = [ 'title', 'editor', 'thumbnail' ];
		$this->rewrite        = [ 'slug' => true ];
		$this->taxonomies     = [];
		$this->public         = true;
		$this->showUI         = true;
		$this->showInMenu     = true;
		$this->showInAdminBar = true;
		$this->showInNavMenus = true;
		$this->showInRest     = false;
		$this->canExport      = true;
		$this->hierarchical   = true;
		$this->hasArchive     = true;
		$this->menuPosition   = 10;
	}

	public function getName(): string {
		return $this->name;
	}

	public function setName( string $name ): void {
		$this->name = $name;
	}

	public function getLabel(): Label {
		return $this->label;
	}

	public function setLabel( Label $label ): void {
		$this->label = $label;
	}

	public function getIcon(): string {
		return $this->icon;
	}

	public function setIcon( string $icon ): void {
		$this->icon = $icon;
	}

	public function getDescription(): string {
		return $this->description;
	}

	public function setDescription( string $description ): string {
		$this->description = $description;
	}

	public function getSupports(): array {
		return $this->supports;
	}

	public function setSupports( array $supports ): void {
		$this->supports = $supports;
	}

	public function getRewrite(): array {
		return $this->rewrite;
	}

	public function setRewrite( array $rewrite ): void {
		$this->rewrite = $rewrite;
	}

	public function getTaxonomies(): array {
		return $this->taxonomies;
	}

	public function setTaxonomies( array $taxonomies ): void {
		$this->taxonomies = $taxonomies;
	}

	public function isPublic(): bool {
		return $this->public;
	}

	public function setPublic( bool $public ): void {
		$this->public = $public;
	}

	public function isShowUI(): bool {
		return $this->showUI;
	}

	public function setShowUI( bool $showUI ): void {
		$this->showUI = $showUI;
	}

	public function isShowInMenu(): bool {
		return $this->showInMenu;
	}

	public function setShowInMenu( bool $showInMenu ): void {
		$this->showInMenu = $showInMenu;
	}

	public function isShowInAdminBar(): bool {
		return $this->showInAdminBar;
	}

	public function setShowInAdminBar( bool $showInAdminBar ): void {
		$this->showInAdminBar = $showInAdminBar;
	}

	public function isShowInNavMenus(): bool {
		return $this->showInNavMenus;
	}

	public function setShowInNavMenus( bool $showInNavMenus ): void {
		$this->showInNavMenus = $showInNavMenus;
	}

	public function canExport(): bool {
		return $this->canExport;
	}

	public function setCanExport( bool $canExport ): void {
		$this->canExport = $canExport;
	}

	public function isHierarchical(): bool {
		return $this->hierarchical;
	}

	public function setHierarchical( bool $hierarchical ): void {
		$this->hierarchical = $hierarchical;
	}

	public function hasArchive(): bool {
		return $this->hasArchive;
	}

	public function setHasArchive( bool $hasArchive ): void {
		$this->hasArchive = $hasArchive;
	}

	public function getMenuPosition(): int {
		return $this->menuPosition;
	}

	public function setMenuPosition( int $menuPosition ): void {
		$this->menuPosition = $menuPosition;
	}

	public function isShowInRest(): bool {
		return $this->showInRest;
	}

	public function setShowInRest( bool $showInRest ): void {
		$this->showInRest = $showInRest;
	}

}
