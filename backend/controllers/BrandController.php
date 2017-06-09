<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\Request;
use yii\web\UploadedFile;
use xj\uploadify\UploadAction;

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
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                if($model->imgFile){
                    $fileName = '/images/brand/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    $model->logo=$fileName;
                }
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
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }

}
