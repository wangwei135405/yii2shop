<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key varchar
 * @property string $password-hash
 * @property string $email
 * @property string $tel
 * @property integer $last_login_time
 * @property integer $last_login_ip
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password;
    public $password_hash;
    public $repassword;
    public $code;
    public static function tableName()
    {
        return 'member';
    }
//    public function chuli(){
//        if($this->password != $this->repassword){
//            $this->addError('repassword','两次密码不一致');
//        }
//    }
    public function denglu(){
        $member = Member::findOne(['username'=>$this->username]);
        if($member){
            //用户存在 验证密码
            if(\Yii::$app->security->validatePassword($this->password,$member->password_hash)){
                //账号秘密正确，登录
                if($this->remember){
                    $time = $this->remember?24*3600:0;

                    \Yii::$app->user->login($member,$time);
                }
                $member->updated_at=time();
                $member->ip=\Yii::$app->request->userIP;
                $member->save();
            }else{
                $this->addError('password','密码不正确');
            }
        }else{
            //账号不存在  添加错误
            $this->addError('username','账号不正确');

        }
    }

    public function rules()
    {
        return [
            [['username','password','repassword'], 'required'],
            [['last_login_time', 'last_login_ip', 'status', 'create_at', 'update_at'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['auth_key', 'email'], 'string', 'max' => 100],
            [['password_hash'], 'string', 'max' => 32],
            [['tel'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key varchar' => 'Auth Key Varchar',
            'password-hash' => '密码',
            'email' => '邮箱',
            'tel' => '电话',
            'last_login_time' => '用户最后登录时间',
            'last_login_ip' => '用户登录ip',
            'status' => '状态',
            'create_at' => '添加时间',
            'update_at' => '修改时间',
            'password'=>'密码',
            'repassword'=>'确认密码',
        ];
    }
}
