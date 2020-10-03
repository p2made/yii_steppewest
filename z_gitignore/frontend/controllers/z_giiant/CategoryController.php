<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\CategorySearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
* This is the class for controller "CategoryController".
*/
//class CategoryController extends \frontend\controllers\base\CategoryController
class CategoryController extends Controller
{
	// public $enableCsrfValidation = false;

	// public function actionIndex()
	// public function actionView($category_id)
	// public function actionCreate()
	// public function actionUpdate($category_id)
	// public function actionDelete($category_id)
	// protected function findModel($category_id)

	/**
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;


	/**
	 * Lists all Category models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel  = new CategorySearch;
		$dataProvider = $searchModel->search($_GET);

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Category model.
	 * @param integer $category_id
	 *
	 * @return mixed
	 */
	public function actionView($category_id)
	{
		\Yii::$app->session['__crudReturnUrl'] = Url::previous();
		Url::remember();
		Tabs::rememberActiveState();

		return $this->render('view', [
			'model' => $this->findModel($category_id),
		]);
	}

	/**
	 * Creates a new Category model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Category;

		try {
			if ($model->load($_POST) && $model->save()) {
				return $this->redirect(['view', 'category_id' => $model->category_id]);
			}
			elseif (!\Yii::$app->request->isPost) {
				$model->load($_GET);
			}
		}
		catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
			$model->addError('_exception', $msg);
		}

		return $this->render('create', ['model' => $model]);
	}

	/**
	 * Updates an existing Category model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $category_id
	 * @return mixed
	 */
	public function actionUpdate($category_id)
	{
		$model = $this->findModel($category_id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(Url::previous());
		}
		else {
			return $this->render('update', ['model' => $model]);
		}
	}

	/**
	 * Deletes an existing Category model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $category_id
	 * @return mixed
	 */
	public function actionDelete($category_id)
	{
		try {
			$this->findModel($category_id)->delete();
		}
		catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
			\Yii::$app->getSession()->addFlash('error', $msg);
			return $this->redirect(Url::previous());
		}

		// TODO: improve detection
		$isPivot = strstr('$category_id',',');
		if ($isPivot == true) {
			return $this->redirect(Url::previous());
		}
		elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
			Url::remember(null);
			$url = \Yii::$app->session['__crudReturnUrl'];
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
		}
		else {
			return $this->redirect(['index']);
		}
	}

	/**
	 * Finds the Category model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $category_id
	 * @return Category the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($category_id)
	{
		if (($model = Category::findOne($category_id)) !== null) {
			return $model;
		}
		else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
