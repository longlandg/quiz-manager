<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="maincontent">
    <div class="user-register">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($user, 'username'); ?>
        <?= $form->field($user, 'password')->passwordInput(); ?>
        <?= $form->field($user, 'level'); ?>
        <?= $form->field($user, 'status'); ?>


        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div><!-- user-register -->
</div>