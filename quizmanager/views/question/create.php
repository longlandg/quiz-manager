<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Question;
use yii\helpers\ArrayHelper;
?>

    <p>this is the question creater</p>



    ?>


<?php $form = ActiveForm::begin(); ?>


    ?>
<?= $form->field($question, 'question') ?>
<?= $form->field($question, 'created_by')->hiddenInput(['value'=>Yii::$app->user->identity->attributes['id']])->label(false); ?>
<?= $form->field($question, 'a') ?>
<?= $form->field($question, 'b') ?>
<?= $form->field($question, 'c') ?>
<?= $form->field($question, 'd') ?>
<?= $form->field($question, 'answer')->dropDownList([
    'a' => 'a',
    'b' => 'b',
    'c' => 'c',
    'd' => 'd',

],['prompt' => 'select correct answer']



)?>

    )?>


    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>