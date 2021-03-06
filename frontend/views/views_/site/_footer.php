<?php
/**
 * _footer.php
 *
 * @author Pedro Plowman
 * @copyright Copyright &copy; Pedro Plowman, 2017
 * @link https://github.com/p2made
 * @package yii2-startbootstrap-themes
 * @license MIT
 */

use rmrevin\yii\fontawesome\FA;
?>

<hr>

<footer>
	<div class="row">
		<div class="col-lg-12">
			<p class="pull-left">
				Copyright <?= FA::i('copyright') ?> Your Website <?= date("Y") ?>
			</p>
			<p class="pull-right">
				<?= Yii::powered() ?>
			</p>
		</div>
	</div>
</footer>
