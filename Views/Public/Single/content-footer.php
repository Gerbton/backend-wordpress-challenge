<?php

use App\Models\PostType\Post;

$_post = new Post( get_post() );
?>

<div class="fc-container">
	<?php if ( $_post->isOpenToSubscribe() ) {
		include "subscribe-form.php";
	} ?>

    <div <?= $_post->isOpenToSubscribe() ? 'hidden' : '' ?>>
        <a href="<?= $_post->getLink() ?>" id="jsLinkToSubscribe" target="_blank">Cadastrar</a>
    </div>
</div>
