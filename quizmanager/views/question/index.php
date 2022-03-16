
<?php
//$this->title = $quiz->title
use yii\widgets\LinkPager;
//var_dump($models);
?>


<div class="background-card">
    <div class="title-block">
        <h1 class="page-title">Question Library</h1>
        <div class="buttons-block"><a href="/question/create" class="btn btn-md btn-green">Create Question</a></div>
    </div>
    <hr>
    <div>

<?php foreach($allQuestions as $quiz){?>
    <div class="card-block">
        <div>
            <h5 class="normal-text"><?=$quiz['question']?> </h5>

        <div>
            <p class="normal-text"><strong>A: </strong><?=$quiz['a']?> </p>
            <p class="normal-text"><strong>B: </strong><?=$quiz['b']?> </p>
            <p class="normal-text"><strong>C: </strong><?=$quiz['c']?> </p>
            <p class="normal-text"><strong>D: </strong><?=$quiz['d']?> </p>
        </div>
        </div>
        <hr>
        <div class="flex-div-element-between">
            <p class="normal-text" style="display: inline"><strong>Created by: </strong><?=$userNames[$quiz['created_by']]?> </p>
        <div>
        <a onclick="return confirm('Are you sure you want to delete this Question?')"href="/question/delete?id=<?=$quiz['id']?>" class="btn btn-sm btn-red left-spacer">Delete</a>
<!--<a href="/question/details?id=--><?//=$quiz['id']?><!--" class="btn btn-success">--><?//=$quiz['question']?><!--</a>-->
        <a href="/question/edit?id=<?=$quiz['id']?>" class="btn btn-sm btn-orange left-spacer">Edit</a>
    </div>
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



