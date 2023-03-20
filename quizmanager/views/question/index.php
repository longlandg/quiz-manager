
<?php

use yii\widgets\LinkPager;
use app\models\User;
use app\models\Category;
?>

<div class="background-card">
    <div class="title-block">
        <h1 class="page-title">Question Library</h1>
        <?php if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_ADMIN) { ?>
            <div class="buttons-block"><a href="/question/create" class="btn btn-md btn-green">Create Question</a></div>
        <?php } ?>
    </div>
    <br>
    <a href="/question/index" class="btn btn-sm btn-orange left-spacer">All</a>
    <a href="/question/index?category=<?=Category::CATEGORY_MATHS?>" class="btn btn-sm btn-orange left-spacer">Maths</a>
    <a href="/question/index?category=<?=Category::CATEGORY_SCIENCE?>" class="btn btn-sm btn-orange left-spacer">Science</a>
    <a href="/question/index?category=<?=Category::CATEGORY_ENGLISH?>" class="btn btn-sm btn-orange left-spacer">English</a>
    <a href="/question/index?category=<?=Category::CATEGORY_HISTORY?>" class="btn btn-sm btn-orange left-spacer">History</a>
    <a href="/question/index?category=<?=Category::CATEGORY_GEOGRAPHY?>" class="btn btn-sm btn-orange left-spacer">Geography</a>
    <hr>
    <div>
        <?php if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_SUPER_ADMIN || Yii::$app->user->identity->attributes['level'] == User::LEVEL_BASIC) { ?>
            <div class="card-block">
                <h3 class="normal-text">You do not have the correct access level to view this page</h3>
            </div>
        <?php } else{
            if(count($questionLibrary) == 0) {
                ?>
                <h3 class="normal-text">There are no Questions in this category </h3>
            <?php  } else { ?>

                <?php foreach($questionLibrary as $question){?>
                    <div class="card-block">
                        <div>
                            <h5 class="normal-text"><?= $question['question'] ?> </h5>
                            <div>
                                <?php if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_BASIC) { ?>
                                    <p class="normal-text"><strong>A: </strong><?= $question['a'] ?> </p>
                                    <p class="normal-text"><strong>B: </strong><?= $question['b'] ?> </p>
                                    <p class="normal-text"><strong>C: </strong><?= $question['c'] ?> </p>
                                    <p class="normal-text"><strong>D: </strong><?= $question['d'] ?> </p>
                                <?php } else {
                                    if ($question['answer'] == 'a') { ?>
                                        <p class="red-text"><strong>A: </strong><?= $question['a'] ?> </p>
                                    <?php } else { ?>
                                        <p class="normal-text"><strong>A: </strong><?= $question['a'] ?> </p>
                                    <?php }
                                    if ($question['answer'] == 'b') { ?>
                                        <p class="red-text"><strong>B: </strong><?= $question['b'] ?> </p>
                                    <?php } else { ?>
                                        <p class="normal-text"><strong>B: </strong><?= $question['c'] ?> </p>
                                    <?php }
                                    if ($question['answer'] == 'c') { ?>
                                        <p class="red-text"><strong>C: </strong><?= $question['c'] ?> </p>
                                    <?php } else { ?>
                                        <p class="normal-text"><strong>C: </strong><?= $question['c'] ?> </p>
                                    <?php }
                                    if ($question['answer'] == 'd') { ?>
                                        <p class="red-text"><strong>D: </strong><?= $question['d'] ?> </p>
                                    <?php } else { ?>
                                        <p class="normal-text"><strong>D: </strong><?= $question['d'] ?> </p>
                                    <?php } ?>

                                <?php } ?>
                            </div>
                        </div>
                        <hr>
                        <div class="flex-div-element-between"><div>
                            <p class="normal-text">Category: <strong><?= $categoryTitles[$question['category_id']] ?></strong></p>
                            <p class="normal-text" style="display: inline">Created by:
                                <strong><?= $userNames[$question['created_by']] ?></strong></p>
                            </div>
                            <div>
                                <?php if (Yii::$app->user->identity->attributes['id'] == $question['created_by']) { ?>
                                    <a href="/question/edit?id=<?= $question['id'] ?>"
                                       class="btn btn-sm btn-orange left-spacer">Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete this Question?')"
                                       href="/question/delete?id=<?= $question['id'] ?>"
                                       class="btn btn-sm btn-red left-spacer">Delete</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ;?>
                <div class="page-selector">
                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pages,
                        'prevPageCssClass' => 'prev',
                        'nextPageCssClass' => 'next',
                    ]);?>
                </div>
            <?php }
        } ?>
    </div>
</div>



