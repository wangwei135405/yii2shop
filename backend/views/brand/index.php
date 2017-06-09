<?=\yii\bootstrap\Html::a('添加',['brand/add'],['class'=>'btn btn-warning btn]-xs'])?>
<table class="table table-bordered">
    <tr>
        <td>ID</td>
        <td>品牌名称</td>
        <td>品牌简介</td>
        <td>品牌logo</td>
        <td>排序</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    <?php foreach($brand as $r):?>
    <tr>
        <td><?=$r->id?></td>
        <td><?=$r->name?></td>
        <td><?=$r->intro?></td>
        <td><img src="<?=$r->logo?>" width='50px'?></td>
        <td><?=$r->sort?></td>
        <td><?=$r->status==0?'隐藏':'正常'?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['brand/edit','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
            <?=\yii\bootstrap\Html::a('删除',['brand/del','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
