<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $username
 * @property string $password
 * @property integer $type
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $status
 * @property string $login_ip
 * @property integer $login_time
 * @property integer $login_count
 * @property integer $update_password
 */
class User extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{   public $authKey;
    /*public $id;
     public $username;
     public $password;
     public $authKey;
     public $accessToken;

     private static $users = [
         '100' => [
             'id' => '100',
             'username' => 'admin',
             'password' => 'admin',
             'authKey' => 'test100key',
             'accessToken' => '100-token',
         ],
         '101' => [
             'id' => '101',
             'username' => 'demo',
             'password' => 'demo',
             'authKey' => 'test101key',
             'accessToken' => '101-token',
         ],
     ];
 */

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'type', 'created_time', 'updated_time', 'status', 'login_time', 'login_count', 'update_password'], 'integer'],
            [['username', 'password', 'created_time', 'updated_time', 'login_ip', 'login_time'], 'required'],
            [['username', 'password'], 'string', 'max' => 70],
            [['login_ip'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'username' => 'Username',
            'password' => 'Password',
            'type' => 'Type',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'status' => 'Status',
            'login_ip' => 'Login Ip',
            'login_time' => 'Login Time',
            'login_count' => 'Login Count',
            'update_password' => 'Update Password',
        ];
    }

    /*查数据*/
    public static function search($params){
        $query = static::find();
        //按title查找
        if(isset($params['username'])){
            $query->andFilterWhere(['and',['like','username',$params['username']],['type'=>2]]);
        }
        $query->andFilterWhere(['type'=>2]);
        $page = isset($params['page']) ? $params['page'] : '';
        $limit = isset($params['limit']) ? $params['limit'] : '';
        $count = 0;
        if($page && $limit){
            $offset = ($page - 1) * $limit;
            $count = $query->count();
            $query->offset($offset)->limit($limit);
        }
        $list = $query->orderBy(['id' => SORT_DESC])->asArray()->all();
        return compact('count', 'list');
    }

    //添加与修改
    public static function insetUpdate($params,$user_id = null){
        $user = new User();
        if($user_id){
            $user = User::findOne($user_id);
            $params['login_count'] = intval($user->login_count) + 1;
        }else{
            $params['created_time'] = time();
            $params['login_time'] = time();
            $params['login_ip'] = $_SERVER["REMOTE_ADDR"];
            $params['type'] = 2;
        }
        $params['updated_time'] = time();
        $params['password'] = \Yii::$app->security->generatePasswordHash($params['password']);
        $user->setAttributes($params);
        if($user->save()){
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = User::find()
            ->where(['username' => $username])
            ->asArray()
            ->one();

        if($user){
            return new static($user);
        }

        return null;
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}