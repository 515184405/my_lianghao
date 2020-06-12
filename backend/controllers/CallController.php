<?php
namespace backend\controllers;

use common\models\TelContact;
use Yii;
use yii\helpers\Json;

/**
 * Site controller
 */
class CallController extends CommonController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        //读数据
        $params = Yii::$app->request->get();
        if(Yii::$app->request->isAjax){
            $data = TelContact::search($params);
            return $this->convertJson('0','查询成功',$data['data'], $data['count']);
        }
        return $this->render('index');
    }
    //创建banner
    public function actionInfo()
    {
        $contact_id = isset($_GET['id']) ? $_GET['id'] : '';
        if(Yii::$app->request->isPost){
            $params = $_POST;
            //存newsModel数据
            $contact_id2 = TelContact::insertUpdate($params,$contact_id);
            if($contact_id2){
                if($contact_id){
                    return Json::encode(array('code'=>'100000','message'=>'修改成功！'));
                }
                return Json::encode(array('code'=>'100000','message'=>'添加成功！'));
            }
            return Json::encode(array('code'=>'100001','message'=>'添加失败！'));
        }
        //查询banner数据
        if($contact_id){
            $data['contact'] = TelContact::find()->where(['id'=>$contact_id])->asArray()->one();
            if(!$data['contact']){
                return '联系人不存在';
            }
        }
        return $this->render('info',compact('data'));
    }


    public function actionDelete(){
        $contact_id = isset($_POST['id']) ? $_POST['id'] : '';
        if(Yii::$app->request->isPost && $contact_id){
            TelContact::deleteAll(['id'=>$contact_id]);
            return Json::encode(['code' => 100000,'message' => '删除成功']);
        }else{
            return Json::encode(['code' => 100000,'message'=> '没有找到要删除的目标']);
        }
    }
}