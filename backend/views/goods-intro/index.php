<table class="table table-bordered">
    <tr>
        <td>商品Id</td>
        <td>商品描述</td>
        <td>操作</td>
    </tr>
    <?php foreach($goodsintro as $r):?>
    <tr>
        <td><?=$r->goods->name?></td>
        <td><?=$r->intro?></td>
        <td></td>
    </tr>
    <?php endforeach;?>
</table>
