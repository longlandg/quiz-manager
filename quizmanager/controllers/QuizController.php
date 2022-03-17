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



class QuizController extends Controller
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

    public function actionIndex()
    {

        if (isset($_GET['category'])) {
            $categoryId = $_GET['category'];
        }

        $projectHelper = New ProjectHelper;

        $userNames = $projectHelper->getUsernames();
        $categoryTitles = $projectHelper->getCategories();


        if (isset($categoryId)) {
            $pagearray = $projectHelper->getPaginatedQuizLibraryByCategory($categoryId);
        } else{



            $pagearray = $projectHelper->getPaginatedQuizLibrary();
    }



        return $this->render('index', [
            'pages' =>  $pagearray[1],
            'quizLibrary' => $pagearray[0],
            'userNames' => $userNames,
            'categoryTitles' => $categoryTitles
            ]);
    }


    public function actionCreate(){

        $quiz = new Quiz();
        $categoryArray = ProjectHelper::getCategoriesArrayForDropDown();
        if ($quiz->load(Yii::$app->request->post())) {
            try {
                if ($quiz->validate()) {
                    $quiz->created_by = Yii::$app->user->identity->attributes['id'];
                    $quiz->save();
                    yii::$app->getSession()->setFlash('success', 'Quiz added successfully');
                    return $this->redirect('index');
                }
            }
            catch (\Exception $e) {
                yii::$app->getSession()->setFlash('error', 'Quiz unsuccessfully created');
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'quiz' => $quiz,
            'categoryArray' => $categoryArray
            ]);
    }

    public function actionEdit($id){

        $quiz = Quiz::find()
            ->where(['id' => $id])
            ->one();

        if ($quiz->load(Yii::$app->request->post())) {
            try{
                if ($quiz->validate()) {
                    $quiz->created_by = Yii::$app->user->identity->attributes['id'];
                    $quiz->save();
                    yii::$app->getSession()->setFlash('success', 'Quiz edited successfully');
                    return $this->redirect('index');
                }
            }

            catch (\Exception $e) {
                yii::$app->getSession()->setFlash('error', 'Quiz unsuccessfully edited');
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

        $projectHelper = New ProjectHelper;
        $quizId = $_GET['id'];
        $quizList = ProjectHelper::getQuizAttributes($quizId);
        $questions = ProjectHelper::getSortQuizQuestions($quizId);

        $quizTitle = $projectHelper->getQuizTitle($quizId);

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
        $categoryId = $_GET['category'];
        $lastPosition = $_GET['position'];
        $nextPosition = $lastPosition + 1;
        $projectHelper = New ProjectHelper;
        $availableQuestions = $projectHelper->getAvailableQuestionsForAQuizByCategory($quizId,$categoryId);
        $usedQuestionIdsForQuiz = $projectHelper->getUsedQuestionIdsForQuiz($quizId);

        $addQuestion = new QuizQuestion();

        if ($addQuestion->load(Yii::$app->request->post())) {
            try {
                if ($addQuestion->validate()) {
                    $addQuestion->save();
                    yii::$app->getSession()->setFlash('success', 'Question added to quiz successfully');
                    return $this->redirect(['quiz/details', 'id' => $quizId]);
                }
            }
            catch (\Exception $e) {
                yii::$app->getSession()->setFlash('error', 'Question unsuccessfully added to quiz ');
                    return $this->redirect('index');
                }
        }

        return $this->render('addquestion', [
            'addQuestion' => $addQuestion,
            'availableQuestions' => $availableQuestions,
            'quizId' => $quizId,
            'nextPosition' => $nextPosition,
            'usedQuestionIdsForQuiz' => $usedQuestionIdsForQuiz,
        ]);
    }

    public function actionDeletequestion($questionId,$quizId){
        $quiz = QuizQuestion::find()
            ->andwhere(['question_id' => $questionId])
            ->andWhere(['quiz_id' => $quizId])
            ->one();
        try {
            $quiz->delete();
            yii::$app->getSession()->setFlash('success', 'Question successfully removed');
            return $this->redirect(['quiz/details', 'id' => $quizId]);
        } catch (\Exception $e) {
            yii::$app->getSession()->setFlash('error', 'Question unsuccessfully removed');
            return $this->redirect(['quiz/details', 'id' => $quizId]);
        }


    }

}