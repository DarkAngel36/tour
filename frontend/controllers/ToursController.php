<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 03.03.2019
 * Time: 18:12
 */

namespace frontend\controllers;

use common\models\Tours;
use common\models\ToursSearch;
use Yii;
use yii\web\Controller;

class ToursController extends Controller
{
    public function actionSelect()
    {
        $searchModel = new ToursSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('select1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSelect2()
    {
        $searchModel = new ToursSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('select2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSelect3()
    {
        $searchModel = new ToursSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('select3', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $data = Yii::$app->request->get();
        $search = new ToursSearch();
        $dataProvider = $search->search(['ToursSearch' => $data]);
//        $items = Tours::find()->where(['status' => 1])->all();
        return $this->render('list', ['items' => $dataProvider->models]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
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

    public function actionGetAjaxFilter()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        switch(Yii::$app->request->get('type', 'city')) {
            case 'city':
                $data = [];
                $cts = \common\models\Cities::getCitiesToDep();
                foreach ($cts as $ct){
                    $data[] = ['id' => $ct->id, 'name' => $ct->name];
                }
                $ret = ['output'=>$data, 'selected'=>''];
                break;
        }

        return $ret;
    }
}