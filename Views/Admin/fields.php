<?php use App\Providers\HelperProvider; ?>

<div class="form-row">

	<?php HelperProvider::registerNonce( $post->post_type ); ?>

    <div class="form-group col-sm-12">
        <label for="fc_link">Link de inscrição</label>
        <input id="fc_link" type="url" class="form-control" name="fuerza[fc_link]" placeholder="https://www.exemplo.com"
               value="<?= get_post_meta( $post->ID, 'fc_link', true ) ?>">
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <label for="fc_workload">Carga horária</label>
        <input id="fc_workload" type="text" class="form-control" name="fuerza[fc_workload]"
               value="<?= get_post_meta( $post->ID, 'fc_workload', true ) ?>">
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <label for="fc_deadline">Data limite</label>
        <input id="fc_deadline" type="text" class="form-control" name="fuerza[fc_deadline]"
               value="<?= get_post_meta( $post->ID, 'fc_deadline', true ) ?>">
    </div>
</div>
