<table class="table table-bordered">
    <tr>
        <td>角色名称</td>
        <td>描述</td>
        <td>所属权限</td>
        <td>操作</td>
    </tr>
    <?php foreach ($roles as $role):?>
    <tr>
        <td><?=$role->name?></td>
        <td><?=$role->description?></td>
        <td>
            <?php
            foreach (Yii::$app->authManager->getPermissionsByRole($role->name) as $permission){
                echo $permission->name;
                echo ',';
            }
            ?>
        </td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['rbac/edit-role','name'=>$role->name],['class'=>'btn btn-warning btn]-xs'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>