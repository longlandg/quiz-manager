<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Question extends ActiveRecord
{

    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question','a','b','c','d','answer','created_by'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'id',
//            'name' => 'Name',
//            'fire' => 'Fire',
//        ];
//    }

    public static function getQuestionLibrary(){
        $activeRecord = Question::find()
            ->orderBy(['id' => SORT_DESC])
            ->all();
        $questionLibrary = [];
        foreach ($activeRecord as $record){
            array_push($questionLibrary, $record["attributes"]);
        }
        return $questionLibrary;
    }

    public static function getQuestion($id){
        $activeRecord = Question::find()
            ->where(['id' => $id])
            ->one();
        $questionContents = $activeRecord['attributes'];

        return $questionContents;
    }
    public function getQuizQuestion()
    {
        return $this->hasMany(QuizQuestion::className(), ['question_id' => 'id']);
    }

}