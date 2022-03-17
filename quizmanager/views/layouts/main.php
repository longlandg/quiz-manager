<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php

    NavBar::begin([
        'brandLabel' => 'Quiz Manager',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $itemsArray;
    if(Yii::$app->user->isGuest) {
        $itemsArray = [];
    } else if (!Yii::$app->user->isGuest && Yii::$app->user->identity->attributes['level'] == User::LEVEL_SUPER_ADMIN) {
        $itemsArray = [
            ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Register', 'url' => ['/user/register']],
                ];
    } else if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->attributes['level'] == User::LEVEL_ADMIN || Yii::$app->user->identity->attributes['level'] == User::LEVEL_STANDARD)) {
        $itemsArray = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Quiz Library', 'url' => ['/quiz/index']],
                ['label' => 'Question Library', 'url' => ['/question/index']],
                ];
    }else if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->attributes['level'] == User::LEVEL_ADMIN || Yii::$app->user->identity->attributes['level'] == User::LEVEL_BASIC)) {
        $itemsArray = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Quiz Library', 'url' => ['/quiz/index']],
        ];
    };
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' =>

            $itemsArray
    ]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' =>

            [

                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]

                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ]
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; WebbiSkools Ltd <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
