<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

	<h1>(M) <?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
