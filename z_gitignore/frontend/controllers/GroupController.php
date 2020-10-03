<?php

namespace frontend\controllers;

use Yii;
use common\models\Group;
use common\models\GroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all Group models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new GroupSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Group model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$providerSubgroup = new \yii\data\ArrayDataProvider([
			'allModels' => $model->subgroups,
		]);
		return $this->render('view', [
			'model' => $this->findModel($id),
			'providerSubgroup' => $providerSubgroup,
		]);
	}

	/**
	 * Creates a new Group model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Group();

		if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
			return $this->redirect(['view', 'id' => $model->group_id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Group model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
			return $this->redirect(['view', 'id' => $model->group_id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Group model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->deleteWithRelated();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Group model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Group the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Group::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	* Action to load a tabular form grid
	* for Subgroup
	* @author Yohanes Candrajaya <moo.tensai@gmail.com>
	* @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
	*
	* @return mixed
	*/
	public function actionAddSubgroup()
	{
		if (Yii::$app->request->isAjax) {
			$row = Yii::$app->request->post('Subgroup');
			if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
				$row[] = [];
			return $this->renderAjax('_formSubgroup', ['row' => $row]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
