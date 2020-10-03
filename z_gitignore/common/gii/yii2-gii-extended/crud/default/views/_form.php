<?php

use yii\helpers\Inflector;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
	$safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\bootstrap4\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id($generator->getModelNameForView()) ?>-form">

	<?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($safeAttributes as $attribute) {
	echo "    <?php echo " . $generator->generateActiveField($attribute) . " ?>\n\n";
} ?>
	<div class="form-group">
		<?= "<?php echo " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?= "<?php " ?>ActiveForm::end(); ?>

</div>
