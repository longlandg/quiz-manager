<?php

namespace app\controllers;

use Yii;
use yii\db\StaleObjectException;
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
        $userNames = $projectHelper->getUsernames();
        $pagearray = $projectHelper->getPaginatedQuizLibrary();

        return $this->render('index', [
            'pages' =>  $pagearray[1],
            'quizLibrary' => $pagearray[0],
            'userNames' => $userNames,
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

    public function actionEdit($id){

        $quiz = Quiz::find()
        ->where(['id' => $id])
        ->one();

        if ($quiz->load(Yii::$app->request->post())) {
            if ($quiz->validate()) {
                $quiz->created_by = Yii::$app->user->identity->attributes['id'];

                $quiz->save();
                yii::$app->getSession()->setFlash('success', 'Quiz edited successfully');
                return $this->redirect('index');
            }
        }

        return $this->render('edit', [
            'quiz' => $quiz,
        ]);



    }

    public function actionDelete($id){

        $quiz = Quiz::findOne($id);
        try {
            $quiz->delete();
            yii::$app->getSession()->setFlash('success', 'Quiz successfully deleted');
            return $this->redirect('index');
        } catch (\Exception $e) {
            yii::$app->getSession()->setFlash('error', 'Quiz unsuccessfully deleted');
            return $this->redirect('index');
        }


    }

    public function actionDetails(){

$quizId = $_GET['id'];
        $quizList = Quiz::getQuizAttributes($quizId);
        $questions = Quiz::getSortQuizQuestions($quizId);
        $projectHelper = New ProjectHelper;
        $quizTitle = $projectHelper->getQuizTitle($quizId);


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
            'positionOfNextQuestion' => $positionOfNextQuestion,
        'quizTitle' => $quizTitle
        ]);
    }

    public function actionAddquestion(){
        $quizId = $_GET['id'];
        $lastPosition = $_GET['position'];
        $nextPosition = $lastPosition + 1;
        $projectHelper = New ProjectHelper;
        $availableQuestions = $projectHelper->getAvailableQuestionsForAQuiz($quizId);
        $usedQuestionIdsForQuiz = $projectHelper->getUsedQuestionIdsForQuiz($quizId);
        $allQuestions = $projectHelper->getAllQuestions();

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
            'availableQuestions' => $availableQuestions,
//            'quizList' => $quizList,
            'quizId' => $quizId,
            'nextPosition' => $nextPosition,
//            'questions' => $questions
        'usedQuestionIdsForQuiz' => $usedQuestionIdsForQuiz,
            'allQuestions' => $allQuestions
        ]);
    }

    public function actionDeletequestion($questionId,$quizId){
        $quiz = QuizQuestion::find()
            ->andwhere(['question_id' => $questionId])
            ->andWhere(['quiz_id' => $quizId])
            ->one();
        try {
            $quiz->delete();
            yii::$app->getSession()->setFlash('success', 'Question successfully deleted');
            return $this->redirect(['quiz/details', 'id' => $quizId]);
        } catch (\Exception $e) {
            yii::$app->getSession()->setFlash('error', 'Question unsuccessfully deleted');
            return $this->redirect(['quiz/details', 'id' => $quizId]);
        }


    }

}