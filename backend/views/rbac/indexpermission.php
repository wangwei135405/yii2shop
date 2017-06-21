<table class="table table-bordered">
    <tr>
        <td>权限名称</td>
        <td>描述</td>
        <td>操作</td>
    </tr>
    <?php foreach($permissions as $permission):?>
    <tr>
        <td><?=$permission->name?></td>
        <td><?=$permission->description?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['rbac/edit-permission','name'=>$permission->name],['class'=>'btn btn-warning btn]-xs'])?>
            <?=\yii\bootstrap\Html::a('删除',['permission/del-permission','name'=>$permission->name],['class'=>'btn btn-warning btn]-xs'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
