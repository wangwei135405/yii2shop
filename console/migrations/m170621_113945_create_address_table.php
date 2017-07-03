<?php

use yii\db\Migration;

/**
 * Handles the creation of table `address`.
 */
class m170621_113945_create_address_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('收货人姓名'),
            'provice'=>$this->string(20)->notNull()->comment('所属省'),
            'city'=>$this->string(20)->notNull()->comment('所属市县'),
            'area'=>$this->string(20)->notNull()->comment('所属区县'),
            'address'=>$this->string(20)->notNull()->comment('详细地址'),
            'tel'=>$this->char(11)->notNull()->comment('联系电话'),
            'status'=>$this->string()->comment('状态'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('address');
    }
}
