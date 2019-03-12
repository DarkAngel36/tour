<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 03.03.2019
 * Time: 18:12
 */

namespace frontend\controllers;

use common\models\Tours;
use Yii;
use yii\web\Controller;

class ToursController extends Controller
{
    public function actionView($id)
    {
        $model = $this->findModel($id);
        print_r($model->attributes);
        die();
    }

    /**
     * Finds the Cities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tours::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}