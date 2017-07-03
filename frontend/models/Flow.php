<?php

namespace frontend\models;

use backend\models\Goods;
use Yii;

/**
 * This is the model class for table "flow".
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $goods_id
 * @property integer $amount
 */
class Flow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'goods_id'], 'required'],
            [['member_id', 'goods_id', 'amount'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'goods_id' => 'Goods ID',
            'amount' => 'Amount',
        ];
    }
    public function getGoodsinfo(){
        return $this->hasOne(Goods::className(),['id'=>'goods_id']);
    }
}
