<?=\yii\bootstrap\Html::a('添加',['user/add'],['class'=>'btn btn-warning btn]-xs'])?>
<table class="table table-bordered">
    <tr>
        <td>ID</td>
        <td>用户名</td>
        <td>密码</td>
        <td>邮箱</td>
        <td>状态</td>
        <td>最后一次登录时间</td>
        <td>地址</td>
        <td>权限</td>
        <td>操作</td>
    </tr>
    <?php foreach($user as $r):?>
    <tr>
        <td><?=$r->id?></td>
        <td><?=$r->username?></td>
        <td><?=$r->password_hash?></td>
        <td><?=$r->email?></td>
        <td><?=$r->status==1?'在线':'下线'?></td>
        <td><?=date('Y-m-d H:i:s',$r->updated_at)?></td>
        <td><?=$r->ip?></td>
        <td>
            <?php
            foreach (Yii::$app->authManager->getRolesByUser($r->id) as $role){
                echo $role->name;
                echo ',';
            }
            ?>
        </td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['user/edit','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
            <?=\yii\bootstrap\Html::a('删除',['user/del','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
