<?php

namespace app\components;

use app\models\Quiz;
use app\models\Question;
use app\models\QuizQuestion;

class ProjectHelper
{
    public function getQuizLibrary(){
        $activeRecord = Quiz::find()
            ->orderBy(['id' => SORT_DESC])
            ->all();
        $quizLibrary = [];
        foreach ($activeRecord as $record){
            array_push($quizLibrary, $record["attributes"]);
        }
        return $quizLibrary;
    }
}