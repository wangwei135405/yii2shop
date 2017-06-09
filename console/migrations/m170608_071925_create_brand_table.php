<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m170608_071925_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->comment('品牌名称'),
            'intro'=>$this->text()->comment('简介'),
            'logo'=>$this->string(255)->comment('图片logo'),
            'sort'=>$this->integer()->comment('排序'),
            'status'=>$this->smallInteger()->comment('状态'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
