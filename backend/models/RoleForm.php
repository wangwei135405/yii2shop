<?php
namespace backend\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class RoleForm extends Model{
    public $name;
    public $description;
    public $permissions=[];

    public function rules(){
        return[
          [['name','description'],'required'],
            ['permissions','safe']
        ];
    }
    public function attributeLabels(){
        return[
          'name'=>'角色名称',
            'description'=>'描述',
            'permissions'=>'所属权限'
        ];
    }
    public static function getPermissionOptions()
    {
        $authManager = \Yii::$app->authManager;
        return ArrayHelper::map($authManager->getPermissions(),'name','description');//获取所有权限
    }
    public function addwayrole(){
        $authManager = \Yii::$app->authManager;
        if($authManager->getRole($this->name)){
            $this->addError('name','该角色名已存在');
        }else{
            $role = $authManager->createRole($this->name);
            $role->description = $this->description;
            if($authManager->add($role)){
                foreach ($this->permissions as $permissionName){
                    $permission = $authManager->getPermission($permissionName);
                    if($permission) $authManager->addChild($role,$permission);
                }
                return true;
        }
        }
            return false;
    }
    public function updateRole($name)
    {
        $authManager = \Yii::$app->authManager;
        $role = $authManager->getRole($name);
        //给角色赋值
        $role->name = $this->name;
        $role->description = $this->description;
        //如果角色名被修改，检查修改后的名称是否已存在
        if($name != $this->name && $authManager->getRole($this->name)){
            $this->addError('name','角色名称已存在');

        }else{
            if($authManager->update($name,$role)){
                //去掉所有与该角色关联的权限
                $authManager->removeChildren($role);
                //关联该角色的权限
                foreach ($this->permissions as $permissionName){
                    $permission = $authManager->getPermission($permissionName);
                    if($permission) $authManager->addChild($role,$permission);
                }
                return true;
            }
        }
        return false;
    }

    public function loadData($role)
    {
        $this->name = $role->name;
        $this->description = $role->description;
        //权限属性赋值
        //获取该角色对应的权限
        $permissions = \Yii::$app->authManager->getPermissionsByRole($role->name);
        //$this->permissions = ['brand/edit','brand/index'];
        foreach ($permissions as $permission){
            $this->permissions[]=$permission->name;
        }

    }

}