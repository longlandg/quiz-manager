<?php

namespace app\controllers;

use app\components\ProjectHelper;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Question;
use app\models\User;



class QuestionController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'edit', 'delete', 'details', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'details'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'edit', 'delete',],
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->user->identity->attributes['level'] < User::LEVEL_STANDARD){
                                return true;
                            }
                            return false;
                        }
                    ],
                ],
            ]
        ];
    }

    public function actionIndex(){

        if (isset($_GET['category'])) {
            $categoryId = $_GET['category'];
        }
        $projectHelper = new ProjectHelper;
        $userNames = $projectHelper->getUsernames();
        $categoryTitles = $projectHelper->getCategories();


        if (isset($categoryId)) {
            $pagearray = $projectHelper->getPaginatedQuestionLibraryByCategory($categoryId);
        } else{



            $pagearray = $projectHelper->getPaginatedQuestionLibrary();
        }

        return $this->render('index', [
            'pages' =>  $pagearray[1],
            'questionLibrary' => $pagearray[0],
            'userNames' => $userNames,
            'categoryTitles' => $categoryTitles
        ]);
    }

    public function actionCreate(){

        $question = new Question();
        $categoryArray = ProjectHelper::getCategoriesArrayForDropDown();

        if ($question->load(Yii::$app->request->post())) {
            try {
                if ($question->validate()) {
                    $question->created_by = Yii::$app->user->identity->attributes['id'];
                    $question->save();
                    yii::$app->getSession()->setFlash('success', 'question created successfully');
                    return $this->redirect('index');
                }
            }
            catch (\Exception $e) {
                yii::$app->getSession()->setFlash('error', 'Question unsuccessfully created');
                return $this->redirect('index');
            }
        }
        return $this->render('create', [
            'question' => $question,
            'categoryArray' => $categoryArray
            ]);
    }

    public function actionEdit($id){

        $question = Question::find()
            ->where(['id' => $id])
            ->one();

        if ($question->load(Yii::$app->request->post())) {
            try {
                if ($question->validate()) {
                    $question->created_by = Yii::$app->user->identity->attributes['id'];
                    $question->save();
                    yii::$app->getSession()->setFlash('success', 'question edited successfully');
                    return $this->redirect('index');
                }
            }
            catch (\Exception $e) {
                yii::$app->getSession()->setFlash('error', 'Question unsuccessfully edited');
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
        }
        catch (\Exception $e) {
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