<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $address
 * @property string $tel
 * @property integer $delivery_id
 * @property integer $payment_id
 * @property string $total
 * @property string $provice
 * @property string $city
 * @property string $area
 * @property integer $status
 * @property integer $create_time
 */
class Order extends \yii\db\ActiveRecord
{
//    public $provice;
//    public $city;
//    public $area;
    //送货方式
    public static $delivery = [
        ['id'=>1,'name'=>'普通快递送货上门','price'=>10.00,'info'=>'每张订单不满499.00元,运费15.00元, 订单4...'],
        ['id'=>2,'name'=>'特快专递','price'=>40.00,'info'=>'每张订单不满499.00元,运费40.00元, 订单4...'],
        ['id'=>3,'name'=>'加急快递送货上门','price'=>40.00,'info'=>'每张订单不满499.00元,运费40.00元, 订单4...'],
        ['id'=>4,'name'=>'平邮','price'=>10.00,'info'=>'每张订单不满499.00元,运费15.00元, 订单4...'],
    ];
    //支付方式
    public static $payment = [
        ['id'=>1,'name'=>'货到付款','info'=>'送货上门后再收款，支持现金、POS机刷卡、支票支付'],
        ['id'=>2,'name'=>'在线支付','info'=>'即时到帐，支持绝大数银行借记卡及部分银行信用卡'],
        ['id'=>3,'name'=>'上门自提','info'=>'自提时付款，支持现金、POS刷卡、支票支付'],
        ['id'=>4,'name'=>'邮局汇款','info'=>'通过快钱平台收款 汇款后1-3个工作日到账'],
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['member_id', 'address', 'delivery_id', 'payment_id', 'total'], 'required'],
//            [['member_id', 'delivery_id', 'payment_id', 'status', 'create_time'], 'integer'],
//            [['total'], 'number'],
//            [['address'], 'string', 'max' => 255],
//            [['tel'], 'string', 'max' => 11],
//            [['provice', 'city', 'area'], 'string', 'max' => 55],
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
            'address' => '收货地址',
            'tel' => '手机号码',
            'delivery_id' => '配送方式id',
            'payment_id' => '支付方式id',
            'total' => '订单金额',
            'provice' => 'Provice',
            'city' => 'City',
            'area' => 'Area',
            'status' => '状态',
            'create_time' => '创建时间',
        ];
    }
}
