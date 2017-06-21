<?php

namespace backend\controllers;
use backend\models\PermissionForm;
use backend\models\RoleForm;
use yii\web\NotFoundHttpException;

class RbacController extends \yii\web\Controller
{
    public function actionIndexPermission()
    {
        $permissions = \Yii::$app->authManager->getPermissions();
        return $this->render('indexpermission', ['permissions' => $permissions]);
    }

    public function actionAddPermission()
    {
        $model = new PermissionForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->addway()) {
                \Yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['index-permission']);
            }

        }
        return $this->render('addpermission', ['model' => $model]);
    }

    public function actionEditPermission($name)
    {
        $permission = \Yii::$app->authManager->getPermission($name);
        if ($permission == null) {
            throw new NotFoundHttpException();
        }
        $model = new PermissionForm();
        //将要修改的权限的值赋值给表单模型
        $model->loadData($permission);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->editway($name)) {
                \Yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['index-permission']);
            }
        }
        return $this->render('addpermission', ['model' => $model]);
    }

    public function actionIndexRole(){
        $roles = \Yii::$app->authManager->getRoles();
        return $this->render('indexrole',['roles'=>$roles]);
    }
    public function actionAddRole(){
        $model = new RoleForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->addwayrole()){
                return $this->redirect(['index-role']);
            }
        }
        return $this->render('addrole',['model'=>$model]);
    }
   public function actionEditRole($name){
    $role = \Yii::$app->authManager->getRole($name);
    if($role==null){
        throw new NotFoundHttpException('角色不存在');
    }

    $model = new RoleForm();
    $model->loadData($role);
    if($model->load(\Yii::$app->request->post()) && $model->validate()){
        if($model->updateRole($name)){
            \Yii::$app->session->setFlash('success','角色修改成功');
            return $this->redirect(['index-role']);
        }
    }

    return $this->render('addrole',['model'=>$model]);
}


}
