<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $create_time
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imgFile;
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','goods_category_id', 'brand_id', 'market_price', 'shop_price', 'stock', 'is_on_sale', 'status'], 'required'],
            [['goods_category_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'create_time','sort'],'integer'],
            [['market_price', 'shop_price'], 'number'],
            [['name', 'sn'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '商品编号',
            'logo' => '商品图像',
            'goods_category_id' => '商品分类ID',
            'brand_id' => '品牌ID',
            'market_price' => '市场价格',
            'shop_price' => '店面价格',
            'stock' => '库存',
            'is_on_sale' => '是否在售',
            'status' => '状态',
            'create_time' => '添加时间',
        ];
    }
    public function getCategory()
    {
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_category_id']);
    }
    public function getBrand()
    {
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
    public function getGoods()
    {
        return $this->hasOne(Goods::className(),['id'=>'goods_id']);
    }
}
