<?php
echo \yii\bootstrap\Html::beginForm(\yii\helpers\Url::to(['goods/index']),'get');
?>
<label>分类名称:</label>
    <input type="text"  id="query" name="keyword">
    <input  type="submit"  value="搜索">
    <br/>
<?php \yii\bootstrap\Html::endForm() ?>

<?=\yii\bootstrap\Html::a('添加',['goods/add'],['class'=>'btn btn-warning btn]-xs'])?>

<table class="table table-bordered">
    <tr>
        <td>ID</td>
        <td>名称</td>
        <td>编号</td>
        <td>商品图片</td>
        <td>商品分类</td>
        <td>品牌分类ID</td>
        <td>库存</td>
        <td>是否在售</td>
        <td>状态</td>
        <td>排序</td>
        <td>添加时间</td>
        <td>操作</td>
    </tr>
    <?php foreach($goods as $r):?>
    <tr>
        <td><?=$r->id?></td>
        <td><?=$r->name?></td>
        <td><?=$r->sn?></td>
        <td><img src="<?=$r->logo?>" width="40px"></td>
        <td><?=$r->goods_category_id?$r->category->name:'顶级分类'?></td>
        <td><?=$r->brand_id?$r->brand->name:''?></td>
        <td><?=$r->stock?></td>
        <td><?=$r->is_on_sale==1?'在售':'未售'?></td>
        <td><?=$r->status==1?'正常':'回收'?></td>
        <td><?=$r->sort?></td>
        <td><?=date('Y-m-d H:i:s',$r->create_time)?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['goods/edit','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
            <?=\yii\bootstrap\Html::a('删除',['goods/del','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
            <?=\yii\bootstrap\Html::a('详情页',['goods/intro','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
'pagination'=>$page,
'nextPageLabel'=>'下一页',
'prevPageLabel'=>'上一页',

]);
