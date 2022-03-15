<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\pagination;
use app\models\Question;


class QuestionController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'edit', 'delete', 'details'],
                'rules' => [
                    [
                        'actions' => ['create', 'edit', 'delete', 'details'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex(){


        $quizList = Question::getQuestionLibrary();


        return $this->render('index', [
            'quizList' => $quizList,
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

    public function actionDetails(){

$quizId = $_GET['id'];
        $question = Question::getQuestion($quizId);


        return $this->render('details', [
            'question' => $question,
            'quizId' => $quizId,
        ]);
    }
}