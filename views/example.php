<?php
/**
 * An example view.
 *
 * Layout: layouts/example.php
 *
 * @package TradeFair
 */

?>
<div class="trade_fair__view">
	<?php \TradeFair::render( 'partials/example', [ 'message' => __( 'Hello World!', 'trade_fair' ) ] ); ?>
</div>
