<?php
/**
 * @var \App\Models\PostType\Post $post
 **/
?>
<div class="fc-container">
    <div class="fc-align-center">
        <p>Carga horária: <span><?= $post->getWorkload() ?></span></p>
        <p>
			<?php if ( $post->isOpenToSubscribe() ) { ?>
                Inscrições até: <span><?= $post->getDeadline() ?></span>
			<?php } else { ?>
                Incrições encerradas
			<?php } ?>
        </p>
    </div>
</div>
