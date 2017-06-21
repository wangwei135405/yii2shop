<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170618_010254_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(50)->notNull(),
            'auth_key'=>$this->string(),
            'password_hash'=>$this->string()->notNull(),
            'password_reset_token'=>$this->string(),
            'email'=>$this->string(),
            'status'=>$this->integer()->notNull(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'ip'=>$this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
