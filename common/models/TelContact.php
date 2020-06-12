<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tel_contact".
 *
 * @property int $id 自增长id
 * @property string $name 联系人姓名
 * @property int $tel 联系人电话
 */
class TelContact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tel_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tel'], 'required'],
            [['createtime'], 'safe'],
            [['tel'], 'string', 'max' => 11],
            [['name'], 'string', 'max' => 50],
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
            'tel' => 'Tel',
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
        $data = $query->asArray()->all();
        return compact('count','data');
    }

//    添加与修改
    public static function insertUpdate($params,$id = null){
        $model = new static();
        $now_time= time();
        $params['createtime']= date('Y-m-d H:i:s',$now_time);//2018-11-28 15:29:29
        if($id){
            $model = $model::findOne($id);
        }
        $model->setAttributes($params);
        if($model->save()){
            if(!$id) {
                return $model->attributes['id'];
            }
            return $id;
        };
        return false;
    }
}
