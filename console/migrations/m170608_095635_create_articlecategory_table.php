<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articlecategory`.
 */
class m170608_095635_create_articlecategory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('articlecategory', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(50)->notNull()->comment('文章分类名'),
            'intro'=>$this->text()->comment('简介'),
            'sort'=> $this->integer()->notNull()->comment('排序'),
            'status'=>$this->smallInteger()->notNull()->comment('状态'),
            'is_help'=>$this->integer()->notNull()->comment('类型'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('articlecategory');
    }
}
