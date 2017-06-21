<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_day_count`.
 */
class m170612_032046_create_goods_day_count_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_day_count', [
            'id' => $this->primaryKey(),
            'day'=>$this->integer()->notNull(),
            'count'=>$this->integer()->notNull()->defaultValue(0)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_day_count');
    }
}
