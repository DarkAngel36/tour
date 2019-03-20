<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 31.01.2019
 * Time: 20:45
 */

namespace backend\controllers;

use common\models\Tours;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class AjaxController extends Controller
{
    /**
     * {@inheritdoc}
     */
/*    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    public function actionFileUpload()
    {
        $post = \Yii::$app->request->post();
        $modelName = str_replace('common\models\\', '', $post['source']);
        $data = UploadedFile::getInstanceByName($modelName . '[img]');
        $class = $post['source'];

        $fileNameArr = explode( '.', $data->name );
        $ext = $fileNameArr[count($fileNameArr ) - 1];
        $path = FileHelper::normalizePath( $class::getTmpImgPath( "{$post['tmp_id']}/{$post['category']}" ) );
        FileHelper::createDirectory( $path );
        $fileName = md5( time() ) . ".$ext";
        $data->saveAs( $path . "/" . $fileName );

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['result' => 'ok', 'fileName' => $fileName];

    }

    public function actionFilesUpload()
    {
        $post = \Yii::$app->request->post();
        $modelName = str_replace('common\models\\', '', $post['source']);
        $data = UploadedFile::getInstanceByName($modelName.'[img_list]');
        $class = $post['source'];

        $fileNameArr = explode( '.', $data->name );
        $ext = $fileNameArr[count($fileNameArr ) - 1];
        $path = FileHelper::normalizePath( $class::getTmpImgPath( "{$post['tmp_id']}/{$post['category']}" ) );
        FileHelper::createDirectory( $path );
        $fileName = md5( time() . $data->name ) . ".$ext";
        $data->saveAs( $path . "/" . $fileName );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['result' => 'ok', 'fileName' => $fileName];

    }

    public function actionFileDelete()
    {
        $post = \Yii::$app->request->post();
        $class = $post['source'];
        $model = $class::find()->where(['=', 'id', $post['source_id']])->one();
        $model->dropImage($post['key'], $post['category']);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['result' => 'ok'];
    }
}