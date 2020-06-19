<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Sign-in';
?>
<!-- page loading spinner -->
<div class="pageload">
    <div class="pageload-inner">
        <div class="sk-rotating-plane"></div>
    </div>
</div>
<!-- /page loading spinner -->
<div class="app signin usersession">
    <div class="session-wrapper">
        <div class="page-height-o row-equal align-middle">
            <div class="column">
                <div class="card bg-white no-border">
                    <div class="card-block">
                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form-layout',"role"=>"form"]]); ?>
                        <div class="text-center m-b">
                            <h4 class="text-uppercase">Welcome back</h4>
                            <p>Please sign in to your account</p>
                        </div>
                        <?= $form->field($model, 'username')->textInput(["class" => "form-control input-lg","placeholder" => "Email Address"]) ?>
                        <?= $form->field($model, 'password')->passwordInput(["class" => "form-control input-lg","placeholder" => "Email Address"]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-lg m-b', 'name' => 'login-button']) ?>
                        </div>

                        <div class="divider">
                            <span>OR</span>
                        </div>
                        <a class="btn btn-block no-bg btn-lg m-b" href="extras-signin.html">Signup</a>
                        <p class="text-center">
                            <small>
                                <em>By clicking Log in you agree to our <a href="#">terms and conditions</a></em>
                            </small>
                        </p>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <a ui-sref="user.forgot" class="bottom-link">Forgotten password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
