<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groupbuildup_element".
 *
 * @property int $groupbuildup_id
 * @property int $element_id
 * @property int $orderbuildup
 *
 * @property Element $element
 * @property Groupbuildup $groupbuildup
 */
class QuizQuestion extends \yii\db\ActiveRecord
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

    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'groupbuildup_id' => 'groupbuildup_id',
//            'element_id' => 'element_id',
//            'orderbuildup' => 'Orderbuildup',
//        ];
//    }

    /**
     * Gets query for [[Element]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuiz()
    {
        return $this->hasOne(Quiz::className(), ['id' => 'quiz_id']);
    }

    /**
     * Gets query for [[Groupbuildup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
}