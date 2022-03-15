<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\pagination;
use app\components\ProjectHelper;
use app\models\Quiz;
use app\models\QuizQuestion;



class QuizController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'edit', 'delete', 'details', 'addquestion'],
                'rules' => [
                    [
                        'actions' => ['create', 'edit', 'delete', 'details', 'addquestion'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex(){

        $projectHelper = New ProjectHelper;
        $quizLibrary = $projectHelper->getQuizLibrary();


        return $this->render('index', [
            'quizLibrary' => $quizLibrary,

        ]);
    }

    public function actionTest(){




        return $this->render('test', [

        ]);
    }

    public function actionCreate(){

        $quiz = new Quiz();

        if ($quiz->load(Yii::$app->request->post())) {
            if ($quiz->validate()) {
           $quiz->created_by = Yii::$app->user->identity->attributes['id'];

                $quiz->save();
                yii::$app->getSession()->setFlash('success', 'Quiz added successfully');
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'quiz' => $quiz,
        ]);



    }

    public function actionDetails(){

$quizId = $_GET['id'];
        $quizList = Quiz::getQuizAttributes($quizId);
        $questions = Quiz::getSortQuizQuestions($quizId);
//        $positionOfNextQuestion;
if(count($questions) > 0) {

    $positionOfNextQuestion = $questions[count($questions)-1]['position']+1;
} else {
    $positionOfNextQuestion = 1;
}

        return $this->render('details', [
            'quizList' => $quizList,
            'quizId' => $quizId,
            'questions' => $questions,
            'positionOfNextQuestion' => $positionOfNextQuestion
        ]);
    }

    public function actionAddquestion(){
        $quizId = $_GET['id'];
        $lastPosition = $_GET['position'];
        $nextPosition = $lastPosition + 1;

        $addQuestion = new QuizQuestion();

        if ($addQuestion->load(Yii::$app->request->post())) {
            if ($addQuestion->validate()) {


                $addQuestion->save();
                yii::$app->getSession()->setFlash('success', 'Question added to quiz successfully');
                return $this->redirect(['quiz/details', 'id' => $quizId]);

            }
        }
//        $quizId = $_GET['id'];
//        $quizList = Quiz::getQuizAttributes($quizId);
//        $questions = Quiz::getSortQuizQuestions($quizId);

        $quizId = $_GET['id'];


        return $this->render('addquestion', [
            'addQuestion' => $addQuestion,
//            'quizList' => $quizList,
            'quizId' => $quizId,
            'nextPosition' => $nextPosition
//            'questions' => $questions
        ]);
    }
}