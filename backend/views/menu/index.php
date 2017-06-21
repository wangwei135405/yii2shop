<table class="table table-bordered">
    <tr>
        <td>名称</td>
        <td>路径</td>
        <td>上级</td>
        <td>排序</td>
        <td>操作</td>
    </tr>
    <?php foreach ($menus as $menu):?>
    <tr>
        <td><?=$menu->label?></td>
        <td><?=$menu->url?></td>
        <td><?=$menu->parent_id?></td>
        <td><?=$menu->sort?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['menu/edit','id'=>$menu->id],['class'=>'btn btn-warning btn]-xs'])?>
            <?=\yii\bootstrap\Html::a('删除',['menu/del','id'=>$menu->id],['class'=>'btn btn-warning btn]-xs'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
