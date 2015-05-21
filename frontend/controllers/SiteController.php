<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

use common\models\service\Service;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            //'access' => [
                //'class' => AccessControl::className(),
                //'only' => ['logout', 'signup'],
                //'rules' => [
                    //[
                        //'actions' => ['signup'],
                        //'allow' => true,
                        //'roles' => ['?'],
                    //],
                    //[
                        //'actions' => ['logout'],
                        //'allow' => true,
                        //'roles' => ['@'],
                    //],
                //],
            //],
            //'verbs' => [
                //'class' => VerbFilter::className(),
                //'actions' => [
                    //'logout' => ['post'],
                //],
            //],
        ];
    }

    /**
     * Action index
     *
     * @return mixed
     **/
    public function actionIndex()
    {
        return $this->render('index');
    }
}
