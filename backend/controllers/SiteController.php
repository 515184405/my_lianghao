<?php
namespace backend\controllers;

use common\models\User;
use common\models\Zixun;
use Yii;
use common\models\LoginForm;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends CommonController
{
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
//                'class' => 'common\components\Mycaptcha',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=>0xffffff,  //背景颜色
                'maxLength' => 4,       //最大显示个数
                'minLength' => 4,       //最少显示个数
                'padding' => 5,         //间距
                'height'=>36,           //高度
                'width' => 100,         //宽度
                'foreColor'=>0x000000,  //字体颜色
                'offset'=>4,            //设置字符偏移量 有效果
                //'controller'=>'login', //拥有这个动作的controller
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    //咨询列表
    public function actionZixun()
    {
        //读数据
        $params = Yii::$app->request->get();
        if(Yii::$app->request->isAjax){
            $data = Zixun::search($params);
            return $this->convertJson('0','查询成功',$data['list'], $data['count']);
        }
        return $this->render('zixun');
    }

    //修改咨询状态
    public function actionInfo()
    {
        //读数据
        $zixun_id = isset($_GET['id']) ? $_GET['id'] : '';
        if(!$zixun_id){
            return Json::encode(array('code' => '100000', 'message' => '修改失败'));
        }
        $params = Yii::$app->request->post();
        if(Yii::$app->request->isAjax){
            if(Zixun::insertUpdate($params,$zixun_id)){
                return Json::encode(array('code' => '100000', 'message' => '修改成功'));
            }
            return Json::encode(array('code' => '100001', 'message' => '修改失败'));
        }
        return Json::encode(array('code' => '100001', 'message' => '修改失败'));
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
//        var_dump(Yii::$app->security->generatePasswordHash('930313'));die;
        $model = new LoginForm();
        if(Yii::$app->request->isPost){
//            var_dump($_POST['verifyCode']);
          if($this->createAction('captcha')->validate($_POST['verifyCode'],false)) {
              if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
                  //return $this->goBack();
                  $user = new User();

                  return Json::encode(array('code' => '100000', 'message' => '登陆成功'));
              } else {
                  return Json::encode(array('code' => '100001', 'message' => '用户名或密码错误'));
              }
          }else{
              return Json::encode(array('code' => '100001', 'message' => '验证码错误'));
          }
        }

        return $this->renderPartial('login');
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/site/login');
    }

    public function actionDemo()
    {
        return $this->render('demo');
    }

    public function actionUploadFile(){
        $model = new \common\models\UploadForm();
        if (Yii::$app->request->isPost) {

            $rootDir = '../../frontend/web/widget/0000/';
            $model->file = UploadedFile::getInstanceByName('file');  //这个方式是js提交
            if ($model->file && $model->validate()) {
                $name = explode('.',$model->file->name);
                $zip = array_pop($name);

                //判断文件名中是否有中文
                if (preg_match("/[\x7f-\xff]/", $model->file->name)) {
                    $name = 'widget00'.'.'.$zip;
                }else{
                    $name = $model->file->name;
                }
                    //解压缩
                    if($zip == 'zip'){
                        $this->unzip($_FILES['file']['tmp_name'],$rootDir);
                    }else{
                        //rar下载
                        is_dir($rootDir) OR mkdir($rootDir, 0777, true);
                        //rar解压功能在不好用   搁置
                        //$this->unrar($_FILES['file']['tmp_name'],$rootDir);
                    }
                $fileSrc=$rootDir . $name;
                if($model->file->saveAs($fileSrc)){
                    return Json::encode(array('code'=>'100000','message'=>'上传成功！'));
                }
                return Json::encode(array('code'=>'100001','message'=>'上传失败！'));

            }
            return Json::encode(array('code'=>'100001','message'=>'上传失败！'));
        }
    }

    /**
     * 解压一个ZIP文件
     * @param  [string] $toName   解压到哪个目录下
     * @param  [string] $fromName 被解压的文件名
     * @return [bool]             成功返回TRUE, 失败返回FALSE
     */
    public function unzip($fromName, $toName)
    {
        $zip = new \ZipArchive();//新建一个ZipArchive的对象
        if ($zip->open($fromName) === TRUE){

            $zip->extractTo($toName);//假设解压缩到在当前路径下images文件夹的子文件夹php
            $zip->close();//关闭处理的zip文件
        }
    }

    public function unrar($fromName, $toName){
        $fromName = iconv('utf-8','gb2312',$fromName);
        $rar_file = rar_open($fromName) or die("Failed to open Rar archive");
        $entries = rar_list($rar_file);
        foreach ($entries as $entry) {
            $entry->extract($toName); /*/dir/extract/to/换成其他路径即可*/
        }
        rar_close($rar_file);
    }

}
