<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170628_104419_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'member_id'=>$this->integer()->notNull(),
            'address'=>$this->string()->notNull()->comment('收货地址'),
            'tel'=>$this->char(11)->comment('手机号码'),
            'delivery_id'=>$this->integer()->notNull()->comment('配送方式id'),
            'payment_id'=>$this->integer()->notNull()->comment('支付方式id'),
            'total'=>$this->decimal(9,2)->notNull()->comment('订单金额'),
            'status'=>$this->integer()->comment('状态'),
            'create_time'=>$this->integer()->comment('创建时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
