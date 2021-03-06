<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace frontend\controllers\base;

use common\models\Subgroup;
	use common\models\SubgroupSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
* SubgroupController implements the CRUD actions for Subgroup model.
*/
class SubgroupController extends Controller
{


/**
* @var boolean whether to enable CSRF validation for the actions in this controller.
* CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
*/
public $enableCsrfValidation = false;


/**
* Lists all Subgroup models.
* @return mixed
*/
public function actionIndex()
{
	$searchModel  = new SubgroupSearch;
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
* Displays a single Subgroup model.
* @param integer $subgroup_id
*
* @return mixed
*/
public function actionView($subgroup_id)
{
\Yii::$app->session['__crudReturnUrl'] = Url::previous();
Url::remember();
Tabs::rememberActiveState();

return $this->render('view', [
'model' => $this->findModel($subgroup_id),
]);
}

/**
* Creates a new Subgroup model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
$model = new Subgroup;

try {
if ($model->load($_POST) && $model->save()) {
return $this->redirect(['view', 'subgroup_id' => $model->subgroup_id]);
} elseif (!\Yii::$app->request->isPost) {
$model->load($_GET);
}
} catch (\Exception $e) {
$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
$model->addError('_exception', $msg);
}
return $this->render('create', ['model' => $model]);
}

/**
* Updates an existing Subgroup model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $subgroup_id
* @return mixed
*/
public function actionUpdate($subgroup_id)
{
$model = $this->findModel($subgroup_id);

if ($model->load($_POST) && $model->save()) {
return $this->redirect(Url::previous());
} else {
return $this->render('update', [
'model' => $model,
]);
}
}

/**
* Deletes an existing Subgroup model.
* If deletion is successful, the browser will be redirected to the 'index' page.
* @param integer $subgroup_id
* @return mixed
*/
public function actionDelete($subgroup_id)
{
try {
$this->findModel($subgroup_id)->delete();
} catch (\Exception $e) {
$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
\Yii::$app->getSession()->addFlash('error', $msg);
return $this->redirect(Url::previous());
}

// TODO: improve detection
$isPivot = strstr('$subgroup_id',',');
if ($isPivot == true) {
return $this->redirect(Url::previous());
} elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
Url::remember(null);
$url = \Yii::$app->session['__crudReturnUrl'];
\Yii::$app->session['__crudReturnUrl'] = null;

return $this->redirect($url);
} else {
return $this->redirect(['index']);
}
}

/**
* Finds the Subgroup model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param integer $subgroup_id
* @return Subgroup the loaded model
* @throws HttpException if the model cannot be found
*/
protected function findModel($subgroup_id)
{
if (($model = Subgroup::findOne($subgroup_id)) !== null) {
return $model;
} else {
throw new HttpException(404, 'The requested page does not exist.');
}
}
}
