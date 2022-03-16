<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<div class="background-card">
    <div class="title-block">
        <h1 class="page-title">Quiz Library</h1>
        <div class="buttons-block"> <a href="/quiz/create" class="btn btn-md btn-green">Create Quiz</a></div>
    </div>
    <hr>
    <div>
        <?php foreach($quizLibrary as $quiz){?>
        <div class="card-block">
            <div>
        <h3 class="normal-text"><?=$quiz['title']?></h3>
        <p class="normal-text">Created by: <strong><?=$userNames[$quiz['created_by']]?></strong></p>

            </div>
            <hr>
            <div class="flex-div-element-end">
        <a onclick="return confirm('Are you sure you want to delete this Quiz?')"href="/quiz/delete?id=<?=$quiz['id']?>" class="btn btn-sm btn-red left-spacer">Delete Quiz</a>
        <a href="/quiz/details?id=<?=$quiz['id']?>" class="btn btn-sm btn-green left-spacer">View Quiz</a>
        <a href="/quiz/edit?id=<?=$quiz['id']?>" class="btn btn-sm btn-orange left-spacer">Edit Quiz Details</a>
                </div>
    </div>

        <?php };?>
<div class="page-selector">
    <?php
        echo LinkPager::widget([
            'pagination' => $pages,
            'prevPageCssClass' => 'prev',
            'nextPageCssClass' => 'next',
        ]);?>
    </div>
    </div>
</div>
