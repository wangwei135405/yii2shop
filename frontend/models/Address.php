<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $name
 * @property string $provice
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $tel
 * @property string $status
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'provice', 'city', 'area', 'address', 'tel'], 'required'],
            [['name', 'status'], 'string', 'max' => 255],
            [['provice', 'city', 'area', 'address'], 'string', 'max' => 20],
            [['tel'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '收货人姓名',
            'provice' => '所属省',
            'city' => '所属市县',
            'area' => '所属区县',
            'address' => '详细地址',
            'tel' => '联系电话',
            'status' => '状态',
        ];
    }
}
