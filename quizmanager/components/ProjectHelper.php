<?php

namespace app\components;

use app\models\Category;
use app\models\User;
use app\models\Quiz;
use app\models\Question;
use app\models\QuizQuestion;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class ProjectHelper extends ActiveRecord
{
//    public function getQuizLibrary(){
//        $activeRecord = Quiz::find()
//            ->orderBy(['id' => SORT_DESC])
//            ->all();
//        $quizLibrary = [];
//        foreach ($activeRecord as $record){
//            $recordAttributes = $record->getAttributes($record->fields());
//            array_push($quizLibrary, $recordAttributes);
//        }
//        return $quizLibrary;
//    }

//    public function getQuizLibraryByTopic($id){
//        $activeRecord = Quiz::find()
//            ->where(['category_id' => $id])
//            ->orderBy(['id' => SORT_DESC])
//            ->all();
//        $quizLibrary = [];
//        foreach ($activeRecord as $record){
//            $recordAttributes = $record->getAttributes($record->fields());
//            array_push($quizLibrary, $recordAttributes);
//        }
//        return $quizLibrary;
//    }

    public function getUsernames(){
        $users = user::find()
            ->all();
        $usernameArray = [];
        foreach ($users as $user){
            $usernameArray[$user["attributes"]['id']] = $user["attributes"]['username'];

        }
        return $usernameArray;
    }

    public function getUsedQuestionIdsForQuiz($quizId){
        $usedQuestions = QuizQuestion::find()
            ->where(['quiz_id' => 1*$quizId])
            ->all();
        $usedQuestionsIdArray = [];
        foreach ($usedQuestions as $question){
            array_push($usedQuestionsIdArray, $question['question_id']);
        }
        return $usedQuestionsIdArray;
    }

//    public function getAllQuestions(){
//        $allquestions = Question::find()
//            ->all();
//        $allQuestionsArray = [];
//        foreach($allquestions as $question){
//            $questionAttributes = $question->getAttributes($question->fields());
//            array_push($allQuestionsArray, $questionAttributes);
//        }
//        return $allQuestionsArray;
//    }

    public function getAllQuestionsByCategory($id){
        $allquestions = Question::find()
            ->where(['category_id' => $id])
            ->all();
        $allQuestionsArray = [];
        foreach($allquestions as $question){
            $questionAttributes = $question->getAttributes($question->fields());
            array_push($allQuestionsArray, $questionAttributes);
        }
        return $allQuestionsArray;
    }

//        public function getAvailableQuestionsForAQuiz($quizId){
//        $allQuestionsArray = self::getAllQuestions();
//            $allUsedQuestionsId = self::getUsedQuestionIdsForQuiz($quizId);
//
//
//$newArray = [];
//
//    foreach($allQuestionsArray as $question){
//        if(!in_array($question['id'], $allUsedQuestionsId)){
//            array_push($newArray,$question);
//        }
//    }
//
//
//return $newArray;
//
//
//
//
//        }

    public function getAvailableQuestionsForAQuizByCategory($quizId,$categoryId){
        $allQuestionsArray = self::getAllQuestionsByCategory($categoryId);
        $allUsedQuestionsId = self::getUsedQuestionIdsForQuiz($quizId);
        $newArray = [];
        foreach($allQuestionsArray as $question){
            if(!in_array($question['id'], $allUsedQuestionsId)){
                array_push($newArray,$question);
            }
        }
        return $newArray;
    }

    public function getQuizTitle($id){
        $quizTitle = quiz::find()
            ->select('title')
            ->where(['id' => $id])
            ->one();

        $quizTitleAttributes = $quizTitle->getAttributes($quizTitle->fields());
        return $quizTitleAttributes['title'];
    }

    public function getPaginatedQuestionLibrary(){
        $questions = Question::find();
        $pages = new Pagination(['defaultPageSize' => 8,'totalCount' => $questions->count()]);
        $allquestions = Question::find()
            ->orderBy(['id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $allQuestionsArray = [];
        foreach($allquestions as $question){
            $questionAttributes = $question->getAttributes($question->fields());
            array_push($allQuestionsArray, $questionAttributes);
        }
        return [$allQuestionsArray,$pages];
    }

    public function getPaginatedQuestionLibraryByCategory($id){
        $questions = Question::find()
            ->where(['category_id' => $id]);
        $pages = new Pagination(['defaultPageSize' => 8,'totalCount' => $questions->count()]);
        $allquestions = Question::find()
            ->where(['category_id' => $id])
            ->orderBy(['id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $allQuestionsArray = [];
        foreach($allquestions as $question){
            $questionAttributes = $question->getAttributes($question->fields());
            array_push($allQuestionsArray, $questionAttributes);
        }
        return [$allQuestionsArray,$pages];
    }

    public function getPaginatedQuizLibrary(){
        $quizes = Quiz::find();
        $pages = new Pagination(['defaultPageSize' => 8,'totalCount' => $quizes->count()]);
        $allquizes = Quiz::find()
            ->orderBy(['id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $allQuizesArray = [];
        foreach($allquizes as $question){
            $questionAttributes = $question->getAttributes($question->fields());
            array_push($allQuizesArray, $questionAttributes);
        }
        return [$allQuizesArray,$pages];
    }

    public function getPaginatedQuizLibraryByCategory($id){
        $quizes = Quiz::find()
            ->where(['category_id' => $id]);
        $pages = new Pagination(['defaultPageSize' => 8,'totalCount' => $quizes->count()]);
        $allquizes = Quiz::find()
            ->where(['category_id' => $id])
            ->orderBy(['id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $allQuizesArray = [];
        foreach($allquizes as $question){
            $questionAttributes = $question->getAttributes($question->fields());
            array_push($allQuizesArray, $questionAttributes);
        }
        return [$allQuizesArray,$pages];
    }

    public static function getQuizAttributes($id){
        $activeRecord = Quiz::find()
            ->where(['id' => $id])
            ->one();
        $quizContents = $activeRecord->attributes;
        return $quizContents;
    }

    public static function getSortQuizQuestions($id)
    {
        $activeRecord = QuizQuestion::find()
            ->where(['quiz_id' => $id])
            ->orderBy(['position' => SORT_ASC])
            ->all();
        $quizQuestionsAttributes = [];
        foreach ($activeRecord as $record){
            $question = Question::getQuestion($record['question_id']);
            $question['position'] = $record['position'];
            array_push($quizQuestionsAttributes, $question);
        }
        return $quizQuestionsAttributes;
    }

    public static function getCategories()
    {
        $activeRecord = Category::find()
            ->all();
        $categoryArray = [];
        foreach ($activeRecord as $category){
            $categoryAttributes = $category->getAttributes($category->fields());
            $categoryArray[$categoryAttributes['id']] = $categoryAttributes['title'];
        }
        return $categoryArray;
    }

    public static function getCategoriesArrayForDropDown()
    {
        $activeRecord = Category::find()
            ->all();
        $categoryArray = [];
        foreach ($activeRecord as $category){
            $categoryAttributes = $category->getAttributes($category->fields());
            array_push($categoryArray, $categoryAttributes);
        }
        return $categoryArray;
    }

    public static function getCategoryTitleById($id)
    {
        $activeRecord = Category::find()
            ->select(['title'])
            ->where(['id' => $id])
            ->one();

        if(!isset($activeRecord->attributes['title'])){
            $title = 'no category on this id';
        } else {
            $title = $activeRecord->attributes['title'];
        }
        return $title;
    }
}

