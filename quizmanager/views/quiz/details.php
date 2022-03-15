<?php
//$this->title = $quiz->title
?>;

<p>this is the quiz details</p>
<?php echo "<pre>";
//var_dump($quizList);
//var_dump($questions);
echo "</pre>";

?>

<?php if($positionOfNextQuestion == 1){ ?>
    <p>there are no questions</p>
<?php }
foreach ($questions as $question){
    $position = $question['position']
    ?>
<div>
    <p><strong>Question</strong><?=$question['question']?></p>

    <div>
        <?php if($question['answer'] == 'a'){ ?>
            <p style="color: firebrick"><strong>A: </strong><?=$question['a']?></p>
       <?php }else { ?>
        <p><strong>A: </strong><?=$question['a']?></p>
        <?php } ?>
    </div>

    <div>
        <?php if($question['answer'] == 'b'){ ?>
            <p style="color: firebrick"><strong>B: </strong><?=$question['b']?></p>
        <?php }else { ?>
            <p><strong>B: </strong><?=$question['b']?></p>
        <?php } ?>
    </div>

    <div>
        <?php if($question['answer'] == 'c'){ ?>
            <p style="color: firebrick"><strong>C: </strong><?=$question['c']?></p>
        <?php }else { ?>
            <p><strong>C: </strong><?=$question['c']?></p>
        <?php } ?>
    </div>

    <div>
        <?php if($question['answer'] == 'd'){ ?>
            <p style="color: firebrick"><strong>D: </strong><?=$question['d']?></p>
        <?php }else { ?>
            <p><strong>D: </strong><?=$question['d']?></p>
        <?php } ?>
    </div>

    <p><?=$question['position']?></p>

</div>
<?php }

?>


<a href="addquestion?id=<?=$quizId?>&position=<?=$positionOfNextQuestion?>" class="btn btn-primary">Add question</a>

