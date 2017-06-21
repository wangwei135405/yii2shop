<?php
/* @var $this yii\web\View */
?>
<h1>aricle-category/index</h1>

<table class="table">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td>编辑 删除</td>
    </tr>
    <?php endforeach;?>
</table>
