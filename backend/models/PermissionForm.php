<?php
namespace backend\models;

use yii\base\Model;

class PermissionForm extends Model{
    public $name;
    public $description;

    public function attributeLabels(){
        return [
            'name'=>'权限名称',
            'description'=>'描述',
        ];
    }
    public function rules(){
        return [
          [['name','description'],'required'],
        ];
    }
    public function addway(){
        $authManager = \Yii::$app->authManager;//\Yii::$app->authManager;
        if($authManager->getPermission($this->name)){
            $this->addError('name','权限已存在');
        }else{
            $permission = $authManager->createPermission($this->name);
            $permission->description = $this->description;
            return $authManager->add($permission);
        }
        return false;
    }
    public function loadData($permission){
        $this->name = $permission->name;
        $this->description = $permission->description;
    }
    public function editway($name)
    {
        $authManager = \Yii::$app->authManager;
        //获取要修改的权限对象
        $permission = $authManager->getPermission($name);
        //判断修改后的权限名称是否存在
        if($name != $this->name && $authManager->getPermission($this->name)){
            $this->addError('name','权限已存在');
        }else{
            //赋值
            $permission->name = $this->name;
            $permission->description = $this->description;
            //更新权限
            return $authManager->update($name,$permission);
        }
        return false;
    }
}