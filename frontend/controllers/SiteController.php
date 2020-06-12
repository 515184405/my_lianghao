<?php
namespace frontend\controllers;

use common\models\CaseType;
use common\models\Banner;
use common\models\Cases;
use common\models\Member;
use common\models\News;
use common\models\UserScope;
use common\models\UserScopeRecord;
use common\models\Widget;
use common\models\WidgetType;
use common\models\Zixun;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\LoginForm2;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends CommonController
{


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
