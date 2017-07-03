<?php

use yii\db\Migration;

/**
 * Handles the creation of table `flow`.
 */
class m170625_063727_create_flow_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('flow', [
            'id' => $this->primaryKey(),
            'member_id'=>$this->integer()->notNull(),
            'goods_id'=>$this->integer()->notNull(),
            'amount'=>$this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('flow');
    }
}
