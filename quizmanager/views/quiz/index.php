<?php

use yii\helpers\Html;
//$this->title = $quiz->title
?>
<div class="title-block">
<h1 class="page-title">Quiz Library</h1>
   <div class="buttons-block"> <a href="/quiz/create" class="btn btn-success">Create Quiz</a></div>
</div>
<hr>


<div>
    <?php foreach($quizLibrary as $quiz){?>
    <div class="quiz-library-card">
        <h4><?=$quiz['title']?></h4>
        <h4><?=$quiz['created_by']?></h4>
        <a href="/quiz/details?id=<?=$quiz['id']?>" class="btn btn-success"><?=$quiz['title']?></a>
    </div>
</div>
<?php }; ?>

