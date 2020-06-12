<?php
namespace backend\controllers;

use common\models\TelLunbo;
use Yii;
use yii\helpers\Json;

/**
 * Site controller
 */
class BannerController extends CommonController
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
            $data = TelLunbo::search($params);
            return $this->convertJson('0','查询成功',$data['data'], $data['count']);
        }
        return $this->render('index');
    }
    //创建banner
    public function actionInfo()
    {
        $banner_id = isset($_GET['id']) ? $_GET['id'] : '';
        if(Yii::$app->request->isPost){
            $params = $_POST;
            //存newsModel数据
            $banner_id2 = TelLunbo::insertUpdate($params,$banner_id);
            if($banner_id2){
                if($banner_id){
                    return Json::encode(array('code'=>'100000','message'=>'修改成功！'));
                }
                return Json::encode(array('code'=>'100000','message'=>'添加成功！'));
            }
            return Json::encode(array('code'=>'100001','message'=>'添加失败！'));
        }
        //查询banner数据
        if($banner_id){
            $data['banner'] = TelLunbo::find()->where(['id'=>$banner_id])->asArray()->one();
            if(!$data['banner']){
                return '轮播图不存在';
            }
        }
        return $this->render('info',compact('data'));
    }


    //设置排序
    public function actionSort(){
        $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $banner = TelLunbo::findOne($id);
        $banner->sort = $sort;
        if($banner->save()){
            return Json::encode(['code' => 100000,'message' => '设置成功']);
        }
        return Json::encode(['code' => 100000,'message' => '设置失败']);
    }

    public function actionDelete(){
        $banner_id = isset($_POST['id']) ? $_POST['id'] : '';
        if(Yii::$app->request->isPost && $banner_id){
            TelLunbo::deleteAll(['id'=>$banner_id]);
            return Json::encode(['code' => 100000,'message' => '删除成功']);
        }else{
            return Json::encode(['code' => 100000,'message'=> '没有找到要删除的目标']);
        }
    }

    //图片上传
    public function actionUploadImage(){
        $uploadImage = $this->uploadImage();
        if(isset($uploadImage)){
            if($uploadImage['status']) {
                return Json::encode(array('code'=>'100000','message'=>'添加成功！','data'=>array(
                    'fileName' => $uploadImage['fileName'],
                    'fileSrc' => '/'.$uploadImage['fileSrc']
                )));
            }else{
                return Json::encode(array('code'=>'100001','message'=>'添加失败！'));
            }
        }
    }
}