<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_category_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Article extends \yii\db\ActiveRecord
{
    public static $status_options = [1=>'正常',0=>'删除'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'article_category_id', 'status', 'sort'], 'required'],
            [['article_category_id', 'status', 'sort', 'inputtime'], 'integer'],
            [['intro'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'article_category_id' => '分类',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '创建时间',
        ];
    }

    public static function getCategoryOptions()
    {
        return ArrayHelper::map(ArticleCategory::find()->where(['status'=>1])->asArray()->all(),'id','name');
    }

    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }
    public function getDetail()
    {
        return $this->hasOne(ArticleDetail::className(),['article_id'=>'id']);
    }

}