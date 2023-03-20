<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Question;
use yii\helpers\ArrayHelper;
?>

<div class="background-card form-width">
    <div class="title-block">
        <h1 class="page-title">Create Quiz</h1>
    </div>
    <hr>
    <div>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($quiz, 'title') ?>

        <?= $form->field($quiz, 'category_id')->dropDownList(
            ArrayHelper::map($categoryArray, 'id', 'title'),['prompt' => 'select category']); ?>

        <?= $form->field($quiz, 'created_by')->hiddenInput(['value'=>Yii::$app->user->identity->attributes['id']])->label(false); ?>
        <hr>
        <div>
            <?= Html::submitButton('Create', ['class' => 'btn btn-sm btn-green']) ?>
            <a href="/quiz" class="btn btn-sm btn-orange left-spacer">Cancel</a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
