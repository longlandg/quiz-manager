<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Quiz;
use yii\helpers\ArrayHelper;
?>

<p>this is the quiz creater</p>



?>


<?php $form = ActiveForm::begin(); ?>


?>
<?= $form->field($quiz, 'title') ?>
<?= $form->field($quiz, 'created_by')->hiddenInput(['value'=>Yii::$app->user->identity->attributes['id']])->label(false); ?>


)?>


    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>