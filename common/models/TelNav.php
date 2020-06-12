<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tel_nav".
 *
 * @property int $id
 * @property string $name 筛选名称
 * @property string $url 筛选条件
 * @property string $createtime 创建时间
 * @property string $imgsrc 图标地址
 * @property int $sort
 */
class TelNav extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tel_nav';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url', 'createtime'], 'required'],
            [['createtime'], 'safe'],
            [['sort','is_recommend'], 'integer'],
            [['name','color'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 100],
            [['imgsrc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'createtime' => 'Createtime',
            'imgsrc' => 'Imgsrc',
            'sort' => 'Sort',
            'color' => 'Color',
            'is_recommend' => 'Is Recommend',
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
        $data = $query->orderBy(['sort'=>SORT_DESC])->asArray()->all();
        return compact('count','data');
    }

//    添加与修改
    public static function insertUpdate($params,$banner_id = null){
        $model = new static();
        $params['sort'] = empty($params['sort']) ? 0 : $params['sort'];
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
