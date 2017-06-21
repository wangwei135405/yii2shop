<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170619_105835_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('名称'),
            'article_category_id'=>$this->integer()->notNull()->comment('分类'),
            'intro'=>$this->text()->comment('简介'),
            'status'=>$this->smallInteger(4)->notNull()->comment('状态'),
            'sort'=>$this->smallInteger(4)->notNull()->comment('排序'),
            'inputtime'=>$this->integer()->comment('创建时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
