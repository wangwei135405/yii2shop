<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ordergoods`.
 */
class m170628_040744_create_ordergoods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ordergoods', [
            'id' => $this->primaryKey(),
            'order_id'=>$this->integer(),
            'goods_id'=>$this->integer(),
            'goods_name'=>$this->string(),
            'logo'=>$this->string(100),
            'price'=>$this->decimal(9,2),
            'amount'=>$this->integer(),
            'total'=>$this->decimal(9,2)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ordergoods');
    }
}
