<?php
use yii\widgets\LinkPager;
use app\models\User;
use app\models\Category;

?>


<div class="background-card">
    <div class="title-block">
        <h1 class="page-title">Quiz Library</h1>
        <?php if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_ADMIN) { ?>
        <div class="buttons-block"> <a href="/quiz/create" class="btn btn-md btn-green">Create Quiz</a></div>
        <?php } ?>

    </div>
    <br>
    <a href="/quiz/index" class="btn btn-sm btn-orange left-spacer">All</a>
    <a href="/quiz/index?category=<?=Category::CATEGORY_MATHS?>" class="btn btn-sm btn-orange left-spacer">Maths</a>
    <a href="/quiz/index?category=<?=Category::CATEGORY_SCIENCE?>" class="btn btn-sm btn-orange left-spacer">Science</a>
    <a href="/quiz/index?category=<?=Category::CATEGORY_ENGLISH?>" class="btn btn-sm btn-orange left-spacer">English</a>
    <a href="/quiz/index?category=<?=Category::CATEGORY_HISTORY?>" class="btn btn-sm btn-orange left-spacer">History</a>
    <a href="/quiz/index?category=<?=Category::CATEGORY_GEOGRAPHY?>" class="btn btn-sm btn-orange left-spacer">Geography</a>
    <hr>
    <div>
        <?php if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_SUPER_ADMIN) { ?>
            <div class="card-block">
                <h3 class="normal-text">You do not have the correct access level to view this page</h3>
            </div>
        <?php } else {
            if(count($quizLibrary) == 0) {
                ?>
                <h3 class="normal-text">There are no Quizes in this category</h3>
            <?php  } else { ?>

                <?php foreach ($quizLibrary as $quiz) { ?>
                    <div class="card-block">
                        <div>
                            <h3 class="normal-text"><?= $quiz['title'] ?></h3>
                            <p class="normal-text">Category: <strong><?= $categoryTitles[$quiz['category_id']] ?></strong></p>
                            <p class="normal-text">Created by: <strong><?= $userNames[$quiz['created_by']] ?></strong></p>
                        </div>
                        <hr>
                        <div class="flex-div-element-end">
                            <?php if (Yii::$app->user->identity->attributes['id'] == $quiz['created_by']) { ?>
                                <a onclick="return confirm('Are you sure you want to delete this Quiz?')"
                                   href="/quiz/delete?id=<?= $quiz['id'] ?>" class="btn btn-sm btn-red left-spacer">Delete</a>
                                <a href="/quiz/edit?id=<?= $quiz['id'] ?>" class="btn btn-sm btn-orange left-spacer">Edit</a>
                            <?php } ?>
                            <a href="/quiz/details?id=<?= $quiz['id'] ?>" class="btn btn-sm btn-green left-spacer">View</a>
                        </div>
                    </div>
                <?php }
            };?>
            <div class="page-selector">
                <?php
                echo LinkPager::widget([
                        'pagination' => $pages,
                    'prevPageCssClass' => 'prev',
                    'nextPageCssClass' => 'next',
                    ]);?>
            </div>
        <?php } ?>
    </div>
</div>
