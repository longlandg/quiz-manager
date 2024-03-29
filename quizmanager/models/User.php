<?php

namespace app\models;

use yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Security;

class User extends ActiveRecord implements IdentityInterface
{

    const LEVEL_SUPER_ADMIN = 1;
    const LEVEL_ADMIN = 2;
    const LEVEL_STANDARD = 3;
    const LEVEL_BASIC = 4;

    const STATUS_ACTIVE = 1;
    const STATUS_RETIRED = 2;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [

            [['username', 'password', 'level', 'status'], 'required'],
            ['username', 'unique']

        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
//        return $this->auth_key;
    }


    public function validateAuthKey($authKey)
    {
//        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (isset($this->password)) {
                $this->password = md5($this->password);
                return parent::beforeSave($insert);
            }
        }
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public static function findByUserName($username)
    {
        return User::findOne(['username' => $username]);
    }

}


