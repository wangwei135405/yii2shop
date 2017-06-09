<?=\yii\bootstrap\Html::a('添加',['articlecategory/add'],['class'=>'btn btn-warning btn]-xs'])?>
<table class="table table-bordered">
    <tr>
        <td>ID</td>
        <td>名称</td>
        <td>简介</td>
        <td>排序</td>
        <td>状态</td>
        <td>类型</td>
        <td>操作</td>
    </tr>
    <?php foreach($article as $r):?>
    <tr>
        <td><?=$r->id?></td>
        <td><?=$r->name?></td>
        <td><?=$r->intro?></td>
        <td><?=$r->sort?></td>
        <td><?=$r->status?></td>
        <td><?=$r->is_help?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['articlecategory/edit','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
            <?=\yii\bootstrap\Html::a('删除',['articlecategory/del','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>