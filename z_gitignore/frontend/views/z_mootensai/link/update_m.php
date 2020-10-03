<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Link */

$this->title = 'Update Link: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Link', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->link_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="link-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
