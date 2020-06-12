<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tel_lunbo".
 *
 * @property int $id
 * @property string $imgsrc 轮播图地址
 * @property string $url 跳转地址
 * @property string $createtime 创建时间
 */
class TelLunbo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tel_lunbo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imgsrc', 'createtime'], 'required'],
            [['createtime'], 'safe'],
            [['sort'], 'integer'],
            [['imgsrc', 'url','desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'imgsrc' => 'Imgsrc',
            'url' => 'Url',
            'sort' => "Sort",
            'desc' => 'Desc',
            'createtime' => 'Createtime',
        ];
    }

    //查询与搜索
    public static function search($params){
        $query = static::find();
        $limit = isset($params['limit']) ? $params['limit'] : 100;
        $page = isset($params['page']) ? $params['page'] : 1;
        $count = 0;
        if($limit && $page){
            $offset = $limit * ($page - 1);
            $count = $query->count();
            $query->offset($offset)->limit($limit);
        }
        $data = $query->orderBy(['sort'=>SORT_ASC])->asArray()->all();
        return compact('count','data');
    }

//    添加与修改
    public static function insertUpdate($params,$banner_id = null){
        $model = new static();
        $params['sort'] = isset($params['sort']) ? $params['sort'] : 0;
        $now_time= time();
        $params['createtime']= date('Y-m-d H:i:s',$now_time);//2018-11-28 15:29:29
        if($banner_id){
            $model = $model::findOne($banner_id);
        }
        $model->setAttributes($params);
        if($model->save()){
            if(!$banner_id) {
                return $model->attributes['id'];
            }
            return $banner_id;
        };
        return false;
    }
}
