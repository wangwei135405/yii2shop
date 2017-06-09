<?=\yii\bootstrap\Html::a('添加',['article/add'],['class'=>'btn btn-warning btn]-xs'])?>
<table class="table table-bordered">
    <tr>
        <td>ID</td>
        <td>名称</td>
        <td>简介</td>
        <td>文章分类id</td>
        <td>排序</td>
        <td>状态</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    <?php foreach($article as $r):?>
        <tr>
            <td><?=$r->id?></td>
            <td><?=$r->name?></td>
            <td><?=$r->intro?></td>
            <td><?=$r->article_category_id?></td>
            <td><?=$r->sort?></td>
            <td><?=$r->status?></td>
            <td><?=$r->create_time?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['article/edit','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
                <?=\yii\bootstrap\Html::a('删除',['article/del','id'=>$r->id],['class'=>'btn btn-warning btn]-xs'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
