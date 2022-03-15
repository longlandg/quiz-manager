<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\QuizQuestion;
use app\models\Question;
use yii\helpers\ArrayHelper;
?>

<p>this is the quiz creater</p>

<p><?=$nextPosition?></p>
<p><?=$quizId?></p>
?>


<?php $form = ActiveForm::begin(); ?>
<?php
$not = ['1','2','3']
?>
<?= $form->field($addQuestion, 'question_id')->dropDownList(
    Question::find()
        ->select(['question', 'id'])
        ->where(['not in', 'id',$not])
        ->indexBy('id')
        ->column(),['prompt' => 'select question']


)


?>

<?= $form->field($addQuestion, 'position')->hiddenInput(['value'=>$nextPosition])->label(false); ?>
<?= $form->field($addQuestion, 'quiz_id')->hiddenInput(['value'=>$quizId])->label(false); ?>


)?>


    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>