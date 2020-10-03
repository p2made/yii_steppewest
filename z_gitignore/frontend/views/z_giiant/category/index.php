<?php
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\CategorySearch $searchModel
 */

use yii\bootstrap4\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

$this->title = Yii::t('category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

if (isset($actionColumnTemplates)) {
	$actionColumnTemplate = implode(' ', $actionColumnTemplates);
	$actionColumnTemplateString = $actionColumnTemplate;
}
else {
	Yii::$app->view->params['pageButtons'] = Html::a(
		'<span class="glyphicon glyphicon-plus"></span> ' . 'New',
		['create'],
		['class' => 'btn btn-success']
	);
	$actionColumnTemplateString = "{view} {update} {delete}";
}
$actionColumnTemplateString = '<div class="action-buttons">'
	. $actionColumnTemplateString . '</div>';

$gridColumns = [
	'name',
	'title',
	'hide',
	[
		'class' => 'yii\grid\ActionColumn',
		'contentOptions' => ['nowrap'=>'nowrap']
	],
	/*
	[
		'class' => 'yii\grid\ActionColumn',
		'template' => $actionColumnTemplateString,
		'buttons' => ['view' => function ($url, $model, $key) {
			$options = [
				'title' => Yii::t('cruds', 'View'),
				'aria-label' => Yii::t('cruds', 'View'),
				'data-pjax' => '0',
			];
			return Html::a(
				'<span class="glyphicon glyphicon-eye-open"></span>',
				$url,
				$options
			);
		}],
		'urlCreator' => function($action, $model, $key, $index) {
			// using the column name as key, not mapping to 'id'
			// like the standard generator
			$params = is_array($key)
				? $key
				: [$model->primaryKey()[0] => (string) $key];
			$params[0] = \Yii::$app->controller->id
				? \Yii::$app->controller->id . '/' . $action
				: $action;
			return Url::toRoute($params);
		},
		'contentOptions' => ['nowrap'=>'nowrap']
	],
	 */
];
?>
<div class="giiant-crud category-index">

	<?php // echo $this->render('_search', ['model' =>$searchModel]) ?>

	<?php \yii\widgets\Pjax::begin([
		'id' => 'pjax-main',
		'enableReplaceState' => false,
		'linkSelector' => '#pjax-main ul.pagination a, th a',
		'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']
	]) ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1>
					(G) <?= Yii::t('category', 'Categories') ?>
					<small>List</small>
				</h1>
			</div>

			<div class="col-sm-6 crud-navigation">
				<div class="float-right">
					<?= Html::a(
						'<span class="glyphicon glyphicon-plus"></span> ' . 'New',
						['create'],
						['class' => 'btn btn-success']
					) ?>

					<?= \yii\bootstrap\ButtonDropdown::widget([
						'id' => 'giiant-relations',
						'encodeLabel' => false,
						'label' => '<span class="glyphicon glyphicon-paperclip"></span> '
							. 'Relations',
						'dropdown' => [
							'options' => ['class' => 'dropdown-menu-right' ],
							'encodeLabels' => false,
							'items' => [[
								'url' => ['group/index'],
								'label' => '<i class="glyphicon glyphicon-arrow-right"></i> '
									. Yii::t('category', 'Group')
							]]
						], 'options' => ['class' => 'btn-default']
					]) ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm">

				<hr>

				<div class="table-responsive">
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => $gridColumns,
						'pager' => [
							'class' => yii\widgets\LinkPager::className(),
							//'firstPageLabel' => 'First',
							//'lastPageLabel' => 'Last',
							'pagination' => ['pageSize' => -1],
						],
						'tableOptions' => [
							'class' => 'table table-striped table-bordered table-hover'
						],
						'headerRowOptions' => ['class' => 'x'],
					]) ?>
				</div>

			</div>
		</div>
	</div>

</div>
<?php \yii\widgets\Pjax::end() ?>

<!-- ##### ^ ##### ^ ##### ^ ##### ^ ##### ^ #####

	##### ^ ##### ^ ##### ^ ##### ^ ##### ^ #####

	##### ^ ##### ^ ##### ^ ##### ^ ##### ^ ##### -->

	<div class="container">
		<div class="row">
			<div class="col-sm-6">
			</div>
			<div class="col-sm">
			</div>
			<div class="col-sm">
			</div>
		</div>
	</div>
