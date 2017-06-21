<table class="table table-bordered">
    <tr>
        <td>名称</td>
        <td>父级分类</td>
        <td>简介</td>
        <td>操作</td>
    </tr>
    <?php foreach($goodscategory as $r):?>
    <tr>
        <td><?=str_repeat(' -',$r->depth).$r->name?></td>
        <td><?=$r->parent_id?$r->parent->name:'顶级分类'?></td>
        <td><?=$r->intro?></td>
        <td></td>
    </tr>
    <?php endforeach;?>
</table>
