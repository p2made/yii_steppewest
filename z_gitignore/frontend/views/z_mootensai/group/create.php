<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Group */

$this->title = 'Create Group';
$this->params['breadcrumbs'][] = ['label' => 'Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-create">

	<h1>(M) <?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
