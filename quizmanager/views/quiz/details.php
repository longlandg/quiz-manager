
<?php

use app\models\User;
?>


<div class="background-card">
    <div class="title-block">
        <h1 class="page-title"><?=$quizTitle?></h1>
        <?php if(Yii::$app->user->identity->attributes['id'] == $quizList['created_by']){ ?>
            <div class="buttons-block"><a href="addquestion?id=<?=$quizId?>&position=<?=$positionOfNextQuestion?>&category=<?=$quizList['category_id']?>" class="btn btn-md btn-green">Add question</a></div>
        <?php } ?>
    </div>
    <hr>
    <div>
        <?php if($positionOfNextQuestion == 1){ ?>
            <h5 class="normal-text">There are currently no questions in this quiz</h5>
        <?php } else {
            foreach ($questions as $question){
                $position = $question['position'] ?>
                <div class="card-block">
                    <div>
                        <h5 class="normal-text"><?=$question['question']?> </h5>
                        <div>
                            <?php if(Yii::$app->user->identity->attributes['level'] == User::LEVEL_BASIC) {?>
                                <p class="normal-text"><strong>A: </strong><?=$question['a']?> </p>
                                <p class="normal-text"><strong>B: </strong><?=$question['b']?> </p>
                                <p class="normal-text"><strong>C: </strong><?=$question['c']?> </p>
                                <p class="normal-text"><strong>D: </strong><?=$question['d']?> </p>
                            <?php } else {
                                if ($question['answer'] == 'a'){ ?>
                                    <p class="red-text"><strong>A: </strong><?=$question['a']?> </p>
                                <?php } else {?>
                                    <p class="normal-text"><strong>A: </strong><?=$question['a']?> </p>
                                <?php }
                                if ($question['answer'] == 'b'){ ?>
                                    <p class="red-text"><strong>B: </strong><?=$question['b']?> </p>
                                <?php } else {?>
                                    <p class="normal-text"><strong>B: </strong><?=$question['c']?> </p>
                                <?php }
                                if ($question['answer'] == 'c'){ ?>
                                    <p class="red-text"><strong>C: </strong><?=$question['c']?> </p>
                                <?php } else {?>
                                    <p class="normal-text"><strong>C: </strong><?=$question['c']?> </p>
                                <?php }
                                if ($question['answer'] == 'd'){ ?>
                                    <p class="red-text"><strong>D: </strong><?=$question['d']?> </p>
                                <?php } else {?>
                                    <p class="normal-text"><strong>D: </strong><?=$question['d']?> </p>
                                <?php }?>

                            <?php }?>
                        </div>
                        <?php if(Yii::$app->user->identity->attributes['id'] == $quizList['created_by']){ ?>
                            <hr>
                            <a onclick="return confirm('Are you sure you want to remove this Question from the Quiz?')"
                               href="/quiz/deletequestion?questionId=<?= $question['id'] ?>&quizId=<?= $quizId ?>"
                               class="btn btn-sm btn-red">Remove</a>
                        <?php } ?>
                    </div>
                </div>

            <?php }
        }?>
        <div class="quiz-back-button"><a href="/quiz/index" class="btn btn-sm btn-orange">Back</a>
        </div>
    </div>
</div>

