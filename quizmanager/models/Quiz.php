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

}