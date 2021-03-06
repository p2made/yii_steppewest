<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Group';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

$gridColumn = [
	['class' => 'yii\grid\SerialColumn'],
	[
		'attribute' => 'group_id',
		'label' => 'ID',
		'width' => '75px',
	],
		[
				'attribute' => 'category_id',
				'label' => 'Category',
				'value' => function($model){
					return $model->category->name;
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => ArrayHelper::map(\common\models\Category::find()->asArray()->all(), 'category_id', 'name'),
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => 'P2m category', 'id' => 'grid-group-search-category_id']
			],
	'name',
	'title',
	//'hide',
	['class' => 'yii\grid\ActionColumn'],
];
?>
<div class="group-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]) ?>

	<p>
		<?= Html::a('Create Group', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
	</p>
	<div class="search-form" style="display:none">
		<?=  $this->render('_search', ['model' => $searchModel]) ?>
	</div>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => $gridColumn,
		'pjax' => true,
		'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-group']],
		'panel' => [
			'type' => GridView::TYPE_PRIMARY,
			'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
		],
		'export' => false,
		// your toolbar can include the additional full export menu
		'toolbar' => [
			'{export}',
			ExportMenu::widget([
				'dataProvider' => $dataProvider,
				'columns' => $gridColumn,
				'target' => ExportMenu::TARGET_BLANK,
				'fontAwesome' => true,
				'dropdownOptions' => [
					'label' => 'Full',
					'class' => 'btn btn-default',
					'itemsBefore' => [
						'<li class="dropdown-header">Export All Data</li>',
					],
				],
				'exportConfig' => [
					ExportMenu::FORMAT_PDF => false
				]
			]) ,
		],
	]) ?>

</div>
