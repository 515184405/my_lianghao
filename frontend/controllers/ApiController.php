<?php
namespace frontend\controllers;


use common\models\TelLunbo;

class ApiController extends CommonController
{
    public function actionIndex(){
        //读数据
        if(Yii::$app->request->isAjax){
            $data = TelLunbo::search();
            return $this->convertJson('2000','查询成功',$data['data'], $data['count']);
        }
    }
}