<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\QuizQuestion;
use app\models\Question;
use yii\helpers\ArrayHelper;
?>
    <div class="background-card form-width">
    <div class="title-block">
        <h1 class="page-title">Add a Question</h1>
    </div>
    <hr>
    <div>


<?php if(count($availableQuestions) == 0 ) { ?>
                    <h3 class="normal-text">There are currently no Questions in this category please go to Question Library and add a new question </h3>
            <?php  } else { ?>

<?php $form = ActiveForm::begin(); ?>
<?php

?>
<?= $form->field($addQuestion, 'question_id')->dropDownList(
    ArrayHelper::map($availableQuestions, 'id', 'question'),['prompt' => 'select question']

)->label(false) ?>



<?= $form->field($addQuestion, 'position')->hiddenInput(['value'=>$nextPosition])->label(false); ?>
<?= $form->field($addQuestion, 'quiz_id')->hiddenInput(['value'=>$quizId])->label(false); ?>




    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-sm btn-green']) ?>
        <a href="/quiz/details?id=<?=$quizId?>" class="btn btn-sm btn-orange left-spacer">Cancel</a>
    </div>
<?php ActiveForm::end();
}?>