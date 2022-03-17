<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class UserController extends Controller
{
    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionRegister()
    {
        $user = new \app\models\User();

        $levels = [['level' => User::LEVEL_SUPER_ADMIN ,
        'level_name' => 'Super Admin'],['level' => User::LEVEL_ADMIN ,
            'level_name' => 'Admin'],['level' => User::LEVEL_STANDARD ,
            'level_name' => 'Standard'],['level' => User::LEVEL_BASIC ,
            'level_name' => 'Basic']];

        $status = [['status' => User::STATUS_ACTIVE ,
            'status_name' => 'Active'],['status' => User::STATUS_RETIRED ,
            'status_name' => 'Retired']];

        if ($user->load(Yii::$app->request->post())) {
            try {
                if ($user->validate()) {
                    $user->save();
                    yii::$app->getSession()->setFlash('success', 'User successfully created');
                    return $this->redirect('/site/index');
                }
            }
            catch (\Exception $e) {
                yii::$app->getSession()->setFlash('error', 'Error: User not created');
                return $this->redirect('/site/index');
            }
        }

        return $this->render('register', [
            'user' => $user,
            'levels' => $levels,
            'status' => $status
        ]);
    }
}


