<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\Request;
use yii\web\UploadedFile;
use xj\uploadify\UploadAction;
use crazyfd\qiniu\Qiniu;

class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $brand = Brand::find()->where(['status'=>1])->all();
        return $this->render('index',['brand'=>$brand]);
    }

    public function actionAdd(){
        $model = new Brand();
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
//            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
//                if($model->imgFile){
//                    $fileName = '/images/brand/'.uniqid().'.'.$model->imgFile->extension;
//                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
//                    $model->logo=$fileName;
//                }
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['brand/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }

    public function actionDel($id){
        $model = Brand::findOne(['id'=>$id]);
        $model->delete();
        return $this->redirect(['brand/index']);
    }

    public function actionEdit($id){
        $model = Brand::findOne(['id'=>$id]);
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
//            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
//                if($model->imgFile){
//                    $fileName = '/images/brand/'.uniqid().'.'.$model->imgFile->extension;
//                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
//                    $model->logo=$fileName;
//                }
                $model->save();
                \Yii::$app->session->setFlash('success','修改成功');
                return $this->redirect(['brand/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }

    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
//                'format' => function (UploadAction $action) {
//                    $fileext = $action->uploadfile->getExtension();
//                    $filename = sha1_file($action->uploadfile->tempName);
//                    return "{$filename}.{$fileext}";
//                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png','gif'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    //$imgUrl = $action->getWebUrl();
                    $action->output['fileUrl'] = $action->getWebUrl();
                   //调用七牛云组件，将图片上传到七牛云
                    //$qiniu = \Yii::$app->qiniu;
                    //$qiniu ->uploadFile(\Yii::getAlias('@webroot').$imgUrl,$imgUrl);
                   //获取该图片七牛云地址
                    //$url = $qiniu->getLink($imgUrl);
                    //$action->output['fileUrl']=$url;
                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }

    public function actionTest()
    {
            $ak = 'xHVnbogsq85xatNfjQHcuwFHMIMxeNa8Rwf9CpyC';
            $sk = 'ntL9PF5aYOBhBwSOWFs2gAwDNbfHfYSxKjFwOZ1k';
            $domain = 'http://or9raiigq.bkt.clouddn.com/';
            $bucket = 'wangwei';
            $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
            $fileName = \Yii::getAlias('@webroot').'/upload/04.jpg';
            $key = '04.jpg';
            $qiniu->uploadFile($fileName,$key);
            $url = $qiniu->getLink($key);
    }

}
