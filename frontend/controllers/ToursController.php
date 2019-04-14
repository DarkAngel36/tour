<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 03.03.2019
 * Time: 18:12
 */

namespace frontend\controllers;

use common\models\HotelsPeriodSearch;
use common\models\HotelsSearch;
use common\models\Tours;
use common\models\ToursSearch;
use Yii;
use yii\web\Controller;

class ToursController extends Controller
{
    public function actionSelect()
    {
	    $searchModel = new HotelsSearch();
        if(Yii::$app->request->isPost) {
	        $dataProvider = $searchModel->search(Yii::$app->request->post());
        } else {
	        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        

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
	        case 'hotel':
	        	$request = Yii::$app->request->post();
	        	
		        $data = [];
		        if (empty($request['depdrop_all_params']['hotelssearch-city_id']))
			        $cts = \common\models\Hotels::find()->all();
		        else
			        $cts = \common\models\Hotels::find()->where(['city_id' => $request['depdrop_all_params']['hotelssearch-city_id']])->all();
		        foreach ($cts as $ct){
			        $data[] = ['id' => $ct->id, 'name' => $ct->name];
		        }
		        $ret = ['output'=>$data, 'selected'=>''];
	        	break;
	        case 'period':
		        $data                   = [];
		        $cts                    = [];
		        $searchPeriod           = new HotelsPeriodSearch();
		        $searchData             = Yii::$app->request->post('depdrop_all_params', [
			        'tourssearch-cityto' => null,
			        'hotel_id'           => null,
		        ]);
		
		        $searchPeriod->cityTo   = $searchData['hotelssearch-city_id'];
		        $searchPeriod->hotel_id = $searchData['hotel_id'];
	        
	            $searched = $searchPeriod->search([]);
	            if($searched->getTotalCount() > 0) {
		            $cts = $searched->getModels();
	            }
		        foreach ($cts as $ct){
			        $data[] = ['id' => $ct->id, 'name' => $ct->from . ' - ' . $ct->to];
		        }
		        
	        	$ret = ['output'=>$data, 'selected'=>''];
	        	break;
        }

        return $ret;
    }
}