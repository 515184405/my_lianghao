<?php
namespace frontend\controllers;


use common\models\China;
use common\models\PhotoList;

class PhotoController extends CommonController
{

    public function actionPhotoList(){

    }

    /**
     * 创建于更新相册
     */
    public function actionCreateUpdate(){

        $params = \Yii::$app->request->post();
        $model = new PhotoList();
        return $model->createUpdate($params);

    }

    public function actionAdd(){
        $json_string = file_get_contents('../web/json/china.json');

        // 用参数true把JSON字符串强制转成PHP数组
        $data = json_decode($json_string, true);

        // 显示出来看看
        $this->add($data);
         die;
    }
}