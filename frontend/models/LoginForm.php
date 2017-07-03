<?php
namespace frontend\models;


use yii\base\Model;

class LoginForm extends Model{
    public $username;
    public $password;
    public $code;
    public $remember;
    public $update_at;
    public $last_login_time;
   public function rules(){
       return[
           [['username','password'],'required'],
           ['username','validateMembername'],
           ['remember','boolean']
       ];
   }
    public function attributeLabels(){
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'code'=>'验证码'
        ];

    }
    //自定义验证方法
    public function validateMembername(){
        $member = Member::findOne(['username'=>$this->username]);
        if($member){
            //用户存在 验证密码
            if(\Yii::$app->security->validatePassword($this->password,$member->password_hash)){
                //账号秘密正确，登录
//                if($this->remember){
                    $time = $this->remember?24*3600:0;

                    \Yii::$app->user->login($member,$time);
//            }
                $member->last_login_time=time();
//                $member->ip=\Yii::$app->request->userIP;
                $member->save(false);
            }else{
                $this->addError('password','密码不正确');
            }
        }else{
            //账号不存在  添加错误
            $this->addError('username','账号不正确');

        }
    }

}