
<?php
//$this->title = $quiz->title
?>


<div class="background-card">
    <div class="title-block">
        <h1 class="page-title"><?=$quizTitle?></h1>
        <div class="buttons-block"><a href="addquestion?id=<?=$quizId?>&position=<?=$positionOfNextQuestion?>" class="btn btn-md btn-green">Add question</a></div>
    </div>
    <hr>
    <div>
        <?php if($positionOfNextQuestion == 1){ ?>
            <p>there are no questions</p>
        <?php } else {


        foreach ($questions as $question){
        $position = $question['position'] ?>
        <div class="card-block">


<div>

                        <h5 class="normal-text"><?=$question['question']?> </h5>


                    <div>
                        <?php if ($question['answer'] == 'a') { ?>
                            <p class="normal-text" style="color: firebrick"><strong>A: </strong><?= $question['a'] ?></p>
                        <?php } else { ?>
                            <p class="normal-text"><strong>A: </strong><?=$question['a'] ?></p>
                        <?php } ?>
                    </div>

                    <div>
                        <?php if ($question['answer'] == 'b') { ?>
                            <p class="normal-text" style="color: firebrick"><strong>B: </strong><?= $question['b'] ?></p>
                        <?php } else { ?>
                            <p class="normal-text"><strong>B: </strong><?= $question['b'] ?></p>
                        <?php } ?>
                    </div>

                    <div>
                        <?php if ($question['answer'] == 'c') { ?>
                            <p class="normal-text" style="color: firebrick"><strong>C: </strong><?= $question['c'] ?></p>
                        <?php } else { ?>
                            <p class="normal-text"><strong>C: </strong><?= $question['c'] ?></p>
                        <?php } ?>
                    </div>

                    <div>
                        <?php if ($question['answer'] == 'd') { ?>
                            <p class="normal-text" style="color: firebrick"><strong>D: </strong><?= $question['d'] ?></p>
                        <?php } else { ?>
                            <p class="normal-text"><strong>D: </strong><?= $question['d'] ?></p>
                        <?php } ?>
                    </div>

<hr>
                    <a onclick="return confirm('Are you sure you want to delete this Question?')"
                       href="/quiz/deletequestion?questionId=<?= $question['id'] ?>&quizId=<?= $quizId ?>"
                       class="btn btn-sm btn-red">Delete</a>
                </div>

        </div>
                <?php }
                }
?>

        <a href="/quiz/index" class="btn btn-sm btn-orange">Back</a>


</div>

