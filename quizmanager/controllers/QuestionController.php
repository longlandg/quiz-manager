<?php

namespace app\controllers;

use app\components\ProjectHelper;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\pagination;
use app\models\Question;
use yii\widgets\LinkPager;


class QuestionController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'edit', 'delete', 'details', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create', 'edit', 'delete', 'details', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex(){

        $projectHelper = new ProjectHelper;
//        $allQuestions = $projectHelper->getAllQuestions();
        $userNames = $projectHelper->getUsernames();
//        $quizList = Question::getQuestionLibrary();

        $pagearray = $projectHelper->getPaginatedQuestionLibrary();




        return $this->render('index', [
//            'models' => $pagearray[0],
           'pages' =>  $pagearray[1],
            'allQuestions' => $pagearray[0],
//            'allQuestions' => $allQuestions,

            'userNames' => $userNames
        ]);
    }

    public function actionCreate(){

        $question = new Question();

        if ($question->load(Yii::$app->request->post())) {
            if ($question->validate()) {
           $question->created_by = Yii::$app->user->identity->attributes['id'];

                $question->save();
                yii::$app->getSession()->setFlash('success', 'question created successfully');
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'question' => $question,

        ]);



    }

    public function actionEdit($id){

        $question = Question::find()
            ->where(['id' => $id])
            ->one();

        if ($question->load(Yii::$app->request->post())) {
            if ($question->validate()) {
                $question->created_by = Yii::$app->user->identity->attributes['id'];

                $question->save();
                yii::$app->getSession()->setFlash('success', 'question edited successfully');
                return $this->redirect('index');
            }
        }

        return $this->render('edit', [
            'question' => $question,
        ]);



    }

    public function actionDelete($id){

        $quiz = Question::findOne($id);
        try {
            $quiz->delete();
            yii::$app->getSession()->setFlash('success', 'Question successfully deleted');
            return $this->redirect('index');
        } catch (\Exception $e) {
            yii::$app->getSession()->setFlash('error', 'Question unsuccessfully deleted');
            return $this->redirect('index');
        }


    }



    public function actionDetails(){

$quizId = $_GET['id'];
        $question = Question::getQuestion($quizId);


        return $this->render('details', [
            'question' => $question,
            'quizId' => $quizId,
        ]);
    }
}