<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Question;
use yii\helpers\ArrayHelper;
?>
<div class="background-card form-width">
    <div class="title-block">
        <h1 class="page-title">Create Question</h1>
    </div>
    <hr>
    <div>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($question, 'question')->textarea(['rows' => '3']) ?>

        <?= $form->field($question, 'category_id')->dropDownList(
            ArrayHelper::map($categoryArray, 'id', 'title'),['prompt' => 'select category']); ?>

        <?= $form->field($question, 'created_by')->hiddenInput(['value'=>Yii::$app->user->identity->attributes['id']])->label(false); ?>

        <?= $form->field($question, 'a')->label('Answer A') ?>

        <?= $form->field($question, 'b')->label('Answer B') ?>

        <?= $form->field($question, 'c')->label('Answer C') ?>

        <?= $form->field($question, 'd')->label('Answer D') ?>

        <?= $form->field($question, 'answer')->dropDownList([
            'a' => 'A',
            'b' => 'B',
            'c' => 'C',
            'd' => 'D',
            ],['prompt' => 'select correct answer']
        )->label('Correct Answer') ?>
        <hr>
        <div>
            <?=Html::submitButton('Create', ['class' => 'btn btn-sm btn-green']) ?>
            <a href="/question" class="btn btn-sm btn-orange left-spacer">Cancel</a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
