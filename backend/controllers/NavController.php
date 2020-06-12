<?php
namespace backend\controllers;

use common\models\TelNav;
use Yii;
use yii\helpers\Json;

/**
 * Site controller
 */
class NavController extends CommonController
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
            $data = TelNav::search($params);
            return $this->convertJson('0','查询成功',$data['data'], $data['count']);
        }
        return $this->render('index');
    }
    //创建nav
    public function actionInfo()
    {
        $nav_id = isset($_GET['id']) ? $_GET['id'] : '';
        if(Yii::$app->request->isPost){
            $params = $_POST;
            //存newsModel数据
            $nav_id2 = TelNav::insertUpdate($params,$nav_id);
            if($nav_id2){
                if($nav_id){
                    return Json::encode(array('code'=>'100000','message'=>'修改成功！'));
                }
                return Json::encode(array('code'=>'100000','message'=>'添加成功！'));
            }
            return Json::encode(array('code'=>'100001','message'=>'添加失败！'));
        }
        //查询nav数据
        if($nav_id){
            $data['nav'] = TelNav::find()->where(['id'=>$nav_id])->asArray()->one();
            if(!$data['nav']){
                return '快捷导航id不存在';
            }
        }
        return $this->render('info',compact('data'));
    }

    public function actionRecommend(){
        $num_id = isset($_POST['id']) ? $_POST['id'] : '';
        if(Yii::$app->request->isPost){
            $params = $_POST;
            //存newsModel数据
            $num_id2 = TelNav::insertUpdate($params,$num_id);
            if($num_id2){
                if($num_id){
                    return Json::encode(array('code'=>'100000','message'=>'修改成功！'));
                }
            }
            return Json::encode(array('code'=>'100001','message'=>'添加失败！'));
        }
    }

    //设置排序
    public function actionSort(){
        $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $nav = TelNav::findOne($id);
        $nav->sort = $sort;
        if($nav->save()){
            return Json::encode(['code' => 100000,'message' => '设置成功']);
        }
        return Json::encode(['code' => 100000,'message' => '设置失败']);
    }

    public function actionDelete(){
        $nav_id = isset($_POST['id']) ? $_POST['id'] : '';
        if(Yii::$app->request->isPost && $nav_id){
            TelNav::deleteAll(['id'=>$nav_id]);
            return Json::encode(['code' => 100000,'message' => '删除成功']);
        }else{
            return Json::encode(['code' => 100000,'message'=> '没有找到要删除的目标']);
        }
    }
}