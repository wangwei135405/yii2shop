<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170619_105617_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->unique()->notNull()->comment('名称'),
            'intro'=>$this->text()->comment('简介'),
            'status'=>$this->smallInteger(4)->notNull()->comment('状态'),
            'sort'=>$this->smallInteger(4)->notNull()->comment('排序'),
            'is_help'=>$this->smallInteger(4)->notNull()->comment('类型'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
