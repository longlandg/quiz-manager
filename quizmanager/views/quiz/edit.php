<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Question;
use yii\helpers\ArrayHelper;
?>
    <div class="background-card form-width">
    <div class="title-block">
        <h1 class="page-title">Edit Quiz Title</h1>
    </div>
    <hr>
    <div>

<?php $form = ActiveForm::begin(); ?>



<?= $form->field($quiz, 'title') ?>
<?= $form->field($quiz, 'created_by')->hiddenInput(['value'=>Yii::$app->user->identity->attributes['id']])->label(false); ?>



    <hr>
    <div>


        <?= Html::submitButton('Submit', ['class' => 'btn btn-sm btn-green']) ?>
        <a href="/quiz" class="btn btn-sm btn-orange left-spacer">Cancel</a>
    </div>
        <?php ActiveForm::end(); ?>
    </div>
    </div>