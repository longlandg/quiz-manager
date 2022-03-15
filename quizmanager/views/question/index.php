
<?php
//$this->title = $quiz->title
?>;

<p>this is the question library</p>
<?php echo "<pre>";
var_dump($quizList);
echo "</pre>";

?>
<a href="/question/create" class="btn btn-success">Create Question</a>
<div style="display: flex">
<?php foreach($quizList as $quiz){?>
    <div class="question-block">
        <h5><?=$quiz['question']?></h5>
        <div style="display: flex; justify-content: space-between ">
            <p>A: <?=$quiz['a']?> </p>
            <p>B: <?=$quiz['b']?> </p>
            <p>C: <?=$quiz['c']?> </p>
            <p>D: <?=$quiz['d']?> </p>
        </div>
<a href="/question/details?id=<?=$quiz['id']?>" class="btn btn-success"><?=$quiz['question']?></a>
    </div>
</div>
<?php }; ?>

