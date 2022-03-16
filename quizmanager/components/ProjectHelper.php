<?php

namespace app\components;

use app\models\User;
use app\models\Quiz;
use app\models\Question;
use app\models\QuizQuestion;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class ProjectHelper extends ActiveRecord
{
    public function getQuizLibrary(){
        $activeRecord = Quiz::find()
            ->orderBy(['id' => SORT_DESC])
            ->all();
        $quizLibrary = [];
        foreach ($activeRecord as $record){
            $recordAttributes = $record->getAttributes($record->fields());
            array_push($quizLibrary, $recordAttributes);
        }
        return $quizLibrary;
    }


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

    public function getAllQuestions(){
        $allquestions = Question::find()
            ->all();
        $allQuestionsArray = [];
        foreach($allquestions as $question){
            $questionAttributes = $question->getAttributes($question->fields());
            array_push($allQuestionsArray, $questionAttributes);
        }

        return $allQuestionsArray;
    }

        public function getAvailableQuestionsForAQuiz($quizId){
        $allQuestionsArray = self::getAllQuestions();
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
        $pages = new Pagination(['defaultPageSize' => 3,'totalCount' => $questions->count()]);
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

    public function getPaginatedQuizLibrary(){
        $quizes = Quiz::find();
        $pages = new Pagination(['defaultPageSize' => 1,'totalCount' => $quizes->count()]);
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


}

