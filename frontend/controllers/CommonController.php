<?php
namespace frontend\controllers;

use common\models\China;
use common\models\Member;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use common\models\UploadForm;
use yii\web\UploadedFile;

class CommonController extends \yii\web\Controller{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        header("Access-Control-Allow-Origin: *");
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config'=>[
                    //上传图片配置
                    //'imageUrlPrefix' => Yii::$app->params['site_url'], /* 图片访问路径前缀 */
                ]
            ]
        ];
    }

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }


    public function sendsMail($title,$htmlBody){
        //邮件发送
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('515184405@qq.com');
        $mail->setSubject($title);
        $mail->setHtmlBody($htmlBody);
        if($mail->send()){
            return true;
        }else{
            return false;
        };
        //邮件发送
    }


}