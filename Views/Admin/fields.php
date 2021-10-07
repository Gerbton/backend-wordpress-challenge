<?php

use App\Models\PostType\Post;
use App\Providers\HelperProvider;

$_post = new Post( $post );
?>

<div class="form-row">

	<?php HelperProvider::registerNonce( $post->post_type ); ?>

    <div class="form-group col-sm-12">
        <label for="fc_link">Link de inscrição</label>
        <input id="fc_link" type="url" class="form-control" name="fuerza[fc_link]" placeholder="https://www.exemplo.com"
               value="<?= $_post->getLink() ?>">
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <label for="fc_workload">Carga horária</label>
        <input id="fc_workload" type="text" class="form-control" name="fuerza[fc_workload]"
               value="<?= $_post->getWorkload() ?>">
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <label for="fc_deadline">Data limite</label>
        <input id="fc_deadline" type="text" class="form-control" name="fuerza[fc_deadline]" data-provide="datepicker"
               data-date-format="dd/mm/yyyy" data-date-language="pt-BR"
               value="<?= $_post->getDeadline() ?>">
    </div>
</div>
