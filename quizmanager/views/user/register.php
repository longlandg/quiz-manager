<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="background-card form-width">
    <div class="title-block">
        <h1 class="page-title">Register User</h1>
    </div>
    <hr>
    <div>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($user, 'username'); ?>

        <?= $form->field($user, 'password')->passwordInput(); ?>

        <?= $form->field($user, 'level')->dropDownList(
                ArrayHelper::map($levels, 'level', 'level_name'),['prompt' => 'select level']); ?>

        <?=$form->field($user, 'status')->dropDownList(
                ArrayHelper::map($status, 'status', 'status_name'), ['prompt' => 'select status'])?>

        <div class="form-group">
            <?= Html::submitButton('Register', ['class' => 'btn btn-sm btn-green']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>