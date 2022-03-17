<?php
use app\models\User;
?>

<div class="background-card">
    <div class="title-block">
        <h1 class="page-title"><strong><?=Yii::$app->user->identity->attributes['username']?></strong> &nbsp; welcome to the Quiz Manager</h1>
    </div>
    <hr>
    <div>
        <div class="card-block">
            <div>
                <?php if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_BASIC) { ?>
                    <P class="normal-text">Your access level is <strong>BASIC</strong></P>
                    <br>
                    <p class="normal-text">You will be able to do the following:</p>
                    <ul>
                        <li class="normal-text">View the Quiz Library</li>
                        <li class="normal-text">View individual Quizzes and their Questions</li>
                    </ul>
                <?php } else if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_STANDARD) { ?>
                    <P class="normal-text">Your access level is <strong>STANDARD</strong></P>
                    <br>
                    <p class="normal-text">You will be able to do the following:</p>
                    <ul>
                        <li class="normal-text">View the Quiz Library</li>
                        <li class="normal-text">View individual Quizzes and their Questions with correct answers highlighted</li>
                        <li class="normal-text">View the Question Library</li>
                        <li class="normal-text">View Questions with correct answers highlighted</li>
                    </ul>
                <?php } else if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_ADMIN) { ?>
                    <P class="normal-text">Your access level is <strong>ADMIN</strong></P>
                    <br>
                    <p class="normal-text">You will be able to do the following:</p>
                    <ul>
                        <li class="normal-text">View the Quiz Library</li>
                        <li class="normal-text">View individual Quizzes and their Questions with correct answers highlighted</li>
                        <li class="normal-text">Create Quizzes</li>
                        <li class="normal-text">Edit your own Quizzes</li>
                        <li class="normal-text">Delete your own Quizzes</li>
                        <li class="normal-text">View the Question Library</li>
                        <li class="normal-text">View Questions with correct answers highlighted</li>
                        <li class="normal-text">Create Questions</li>
                        <li class="normal-text">Edit your own Questions</li>
                        <li class="normal-text">Delete your own Questions</li>
                    </ul>
                <?php }  else if (Yii::$app->user->identity->attributes['level'] == User::LEVEL_SUPER_ADMIN) { ?>
                    <P class="normal-text">Your access level is <strong>SUPER ADMIN</strong></P>
                    <br>
                    <p class="normal-text">You will be able to do the following:</p>
                    <ul>
                        <li class="normal-text">Register new users</li>
                    </ul>

                <?php } ?>
            </div>
        </div>
    </div>
</div>
