<?php ?>

<div class="fc-container">
    <h2 class="fc-title fc-title--form">Tenho interesse</h2>
    <form action="" class="fc-d-flex" id="jsFuerzaSubscribeForm">
        <input type="hidden" name="fc_nonce" value="<?= wp_create_nonce( 'wp_rest' ) ?>">
        <input type="hidden" name="post_id" id="fc_post_id" value="<?= get_the_ID() ?>">
        <div class="fc-group">
            <label for="fc_name">Nome</label>
            <input type="text" name="name" id="fc_name" class="fc_input" placeholder="Jonh Due">
        </div>
        <div class="fc-group">
            <label for="fc_email">Email</label>
            <input type="email" name="email" id="fc_email" class="fc_input" placeholder="jonh@email.com">
        </div>
        <div class="fc-group">
            <button type="submit">Cadastrar</button>
        </div>
    </form>
</div>
