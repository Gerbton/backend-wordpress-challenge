<form class="fc-form" id="jsFuerzaSubscribeForm">
    <h2 class="fc-title fc-title--form">Tenho interesse</h2>

    <input type="hidden" name="_wpnonce" value="<?= wp_create_nonce( 'wp_rest' ) ?>">
	<input type="hidden" name="post_id" id="fc_post_id" value="<?= $_post->getID() ?>">

    <div class="col-12">
        <div class="fc-group">
            <label for="fc_name">Nome</label>
            <input type="text" name="name" id="fc_name" class="fc-input" placeholder="Jonh Due">
        </div>
    </div>

    <div class="col-12">
        <div class="fc-group">
            <label for="fc_email">Email</label>
            <input type="email" name="email" id="fc_email" class="fc-input" placeholder="jonh@email.com">
        </div>
    </div>

    <div class="col-12 fc-margin-top-2">
        <div class="fc-group">
            <button class="fc-button" type="submit">Cadastrar</button>
        </div>
    </div>
</form>