<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class QuizQuestion extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quiz_id', 'question_id', 'position'], 'required'],
            [['quiz_id', 'question_id', 'position'], 'integer'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => quiz::className(), 'targetAttribute' => ['quiz_id' => 'id']],
        ];
    }

    public function getQuiz()
    {
        return $this->hasOne(Quiz::className(), ['id' => 'quiz_id']);
    }

    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
}