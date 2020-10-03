<?php
/**
 * login.php
 *
 * @author Pedro Plowman
 * @copyright Copyright &copy; Pedro Plowman, 2017
 * @link https://github.com/p2made
 * @package yii2-startbootstrap-themes
 * @license MIT
 */

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use p2m\helpers\FA;
use p2m\helpers\BSocial;

$this->title = 'Login';
?>

	<!-- Every page had one or more boxes each enclosed in a row -->
	<!-- This page has one box -->

<div class="row">
	<div class="box">
		<div class="col-lg-12">
			<hr>
			<h2 class="intro-text text-center">
				<?= Html::encode($this->title) ?>
				<strong>to start your session</strong>
			</h2>
			<hr>
		</div>
		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-info">
				<div class="panel-body">
					<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

					<?= $form->field($model, 'username')->textInput([
						'autofocus' => true
					]) ?>

					<?= $form->field($model, 'password')->passwordInput() ?>

					<?= $form->field($model, 'rememberMe')->checkbox() ?>

					<div style="color:#999;margin:1em 0">
						If you forgot your password you can
						<?= Html::a('reset it', ['site/request-password-reset']) ?>.
					</div>

					<div class="form-group">
						<?= Html::submitButton('Login', [
							'class' => 'btn btn-primary', 'name' => 'login-button'
						]) ?>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>

			<p class="text-center">- OR -</p>

		</div>

		<div class="col-lg-3 col-lg-offset-3">
			<?= BSocial::b('github')->caption('Login using @@@') ?>
			<?= BSocial::b('google')->caption('Login using @@@') ?>
		</div>
		<div class="col-lg-3">
			<?= BSocial::b('twitter')->caption('Login using @@@') ?>
			<?= BSocial::b('facebook')->caption('Login using @@@') ?>
		</div>
	</div>
</div>
