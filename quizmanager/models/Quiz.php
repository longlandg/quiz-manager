<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Quiz extends ActiveRecord
{

    public static function tableName()
    {
        return 'quiz';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','category_id','created_by'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'category_id' => 'Category',
            'created_by' => 'Created by',
        ];
    }

//    public static function getQuizLibrary(){
//        $activeRecord = Quiz::find()
//            ->all();
//        $quizLibrary = [];
//        foreach ($activeRecord as $record){
//            array_push($quizLibrary, $record["attributes"]);
//        }
//        return $quizLibrary;
//    }

//    public static function getQuizAttributes($id){
//        $activeRecord = Quiz::find()
//            ->where(['id' => $id])
//            ->one();
//        $quizContents = $activeRecord->attributes;
//
//        return $quizContents;
//    }

//    public static function getSortQuizQuestions($id)
//    {
//        $activeRecord = QuizQuestion::find()
//            ->where(['quiz_id' => $id])
//            ->orderBy(['position' => SORT_ASC])
//            ->all();
//        $quizQuestionsAttributes = [];
//        foreach ($activeRecord as $record){
//            $question = Question::getQuestion($record['question_id']);
//            $question['position'] = $record['position'];
//            array_push($quizQuestionsAttributes, $question);
//        }
//
//        return $quizQuestionsAttributes;
//    }
}