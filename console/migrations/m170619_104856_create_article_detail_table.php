<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_detail`.
 */
class m170619_104856_create_article_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_detail', [
            'article_id' => $this->primaryKey()->comment('文章id'),
            'content' => $this->text()->notNull()->comment('内容'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_detail');
    }
}
