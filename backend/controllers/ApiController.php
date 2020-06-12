<?php

namespace backend\controllers;

use common\models\TelContact;
use common\models\TelList;
use common\models\TelLunbo;
use common\models\TelNav;
use yii\web\Controller;

class ApiController extends Controller
{

    /**转Json格式
     * @param $code
     * @param $message
     * @param $data
     * @param $count
     * @return string
     */
    public function convertJson($code, $message, $data = '', $count = null)
    {

        $Json['code'] = $code;
        $Json['msg'] = $message;
        $Json['data'] = $data;
        if (!empty($count)) {
            $Json['count'] = $count;
        }
        return json_encode($Json);

    }

    public function getOnline(){
        return array(
            array('id' => '1','title' =>  '移动网络'),
            array('id' => '2','title' =>  '联通网络'),
            array('id' => '3','title' =>  '电信网络'),
        );
    }

    /* 获取首页数据 */
    public function actionIndex(){
        //读数据

        /* 轮播 */
        $banner = TelLunbo::find()->asArray()->all();

        /* 导航 */
        $nav = TelNav::find()->where(['is_recommend'=>1])->orderBy(['sort'=>SORT_DESC])->asArray()->all();

        /* 推荐列表 */
        $recommend = TelList::find()->limit(20)->asArray()->all();

        /* 最新列表 */
        $news = TelList::find()->orderBy(['id'=>SORT_DESC])->limit(20)->asArray()->all();
        $data = [
            'banner' => $banner,
            'nav'    => $nav,
            'recommend' => $recommend,
            'news'   => $news,
            'online' => $this->getOnline(),
            'site_url' => \Yii::$app->params['backend_url'],
        ];
        return $this->convertJson('200','查询成功',$data,0);
    }

    /* 获取联系人数据 */
    public function actionUserList(){
        /* 最新列表 */
        $contact = TelContact::find()->asArray()->all();
        return $this->convertJson('200','查询成功',$contact,0);
    }

    /* 获取号码列表 */
    public function actionSelectTel(){
        //读数据
        $params = \Yii::$app->request->get();
        $numberList = TelList::search($params);
        $nav = TelNav::find()->orderBy(['sort'=>SORT_DESC])->asArray()->all();
        $data = [
            'numerList' => $numberList['data'],
            'online' => $this->getOnline(),
            'nav' => $nav,
        ];
        return $this->convertJson('200','查询成功',$data, 0);
    }
}