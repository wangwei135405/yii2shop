<?php
namespace backend\models;

use yii\base\Model;

class LoginForm extends Model{
    public $username;
    public $password;
    public $remember;
    public $updated_at;
    public $ip;

    public function attributeLabels(){
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'remember'=>'点击自动保存'
        ];
    }
    public function rules(){
        return[
            [['username','password'],'required'],
            ['username','validateUsername'],
            ['code','safe'],
            ['remember','boolean']
        ];
    }

    //自定义验证方法
    public function validateUsername(){
        $user = User::findOne(['username'=>$this->username]);
        if($user){
            //用户存在 验证密码
            if(\Yii::$app->security->validatePassword($this->password,$user->password_hash)){
                //账号秘密正确，登录
                if($this->remember){
                    $time = $this->remember?24*3600:0;

                \Yii::$app->user->login($user,$time);
                }
                $user->updated_at=time();
                $user->ip=\Yii::$app->request->userIP;
                $user->save();
            }else{
                $this->addError('password','密码不正确');
            }
        }else{
            //账号不存在  添加错误
            $this->addError('username','账号不正确');

        }
    }

}