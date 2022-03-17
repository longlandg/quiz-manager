<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{

    const CATEGORY_MATHS = 1;
    const CATEGORY_SCIENCE = 2;
    const CATEGORY_ENGLISH = 3;
    const CATEGORY_HISTORY = 4;
    const CATEGORY_GEOGRAPHY = 5;

    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
        ];
    }


}