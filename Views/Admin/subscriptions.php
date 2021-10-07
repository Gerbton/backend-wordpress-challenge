<?php

use App\Models\Subscription;

$subscriptions = Subscription::findByPostID( $post->ID );

if ( $subscriptions ) { ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Registro</th>
        </tr>
        </thead>
        <tbody>

		<?php foreach ( $subscriptions as $subscription ) {
			$registerDate = $subscription->getCreatedAt(); ?>

            <tr>
                <th scope="row"><?= $subscription->getId() ?></th>
                <td><?= $subscription->getName() ?></td>
                <td><?= $subscription->getEmail() ?></td>
                <td><?= $registerDate instanceof DateTime ? $registerDate->format( 'd/m/Y' ) : '-' ?></td>
            </tr>

		<?php } ?>

        </tbody>
    </table>
<?php }