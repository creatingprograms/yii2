<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\modules\forum\models\Category;
use backend\modules\catalog\models\StoreCategory;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreAttribute;
use backend\modules\catalog\models\StoreAttributeGroup;
use backend\modules\catalog\models\StoreProduct;
use yii\web\UploadedFile;
use DateTime;
use DateTimeZone;
/**
 * MenuitemController implements the CRUD actions for Menuitem model.
 */
class AjaxController extends Controller
{
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    //фильтр товаров на фронте, перебираем товары, внутри каждого товара перебираем пришедшие с фронта фильтры и в случае если все они
    //имеюются в таблице StoreAttributeValue, добавляем данный товар в массив товаров, которые возвращаем на фронт.
    public function actionView()
    {
        $data = Yii::$app->request->post();
        //print_r($data);
        $products = StoreProduct::find()->where(['category_id'=>$data['StoreAttributeGroup']['category']])->all();
        unset($data['StoreAttributeGroup']);
        $data1 = array_diff($data, array('', NULL, false));
        $counts = [];
        $filters = [];
        foreach ($products as $p){
            $l = 0;
            foreach ($data1 as $d){
                if(!empty($d)){
                    $n = StoreAttributeValue::find()->where(['product_id'=>$p->id])->andWhere(['attribute_id'=>$d])->one();
                    if(!empty($n)){
                        array_push($counts, $n);
                        $l++;
                    }
                }
            }
            if($l==count($data1)){
                array_push($filters, $p);
            }
        }
        
        //$data2 = ['/'=>'--Не выбрано--', ''=>'Все портфолио'];
        //print_r(\Yii::$app->request->post('dataname'));
        //$data1 = StoreProduct::find()->select(['title', 'id'])->indexBy('id')->column();
        //$data = array_merge($data2, $data1);
        //$res = \Yii::$app->getResponse();
        //$res->format = \yii\web\Response::FORMAT_JSON;
        //$res->data = $data;
        //$res->send();
        return $this->renderAjax('filter', [
            //'filters' => \Yii::$app->request->post('data'),
            'filters' => $filters,
        ]);
			//$products = StoreAttributeValue::find()->where(['product_id'=>$model->product_id])->all();
			//$res = \Yii::$app->getResponse();	
			//$res->format = \yii\web\Response::FORMAT_JSON;
			//$res->data = $products;
			//$res->send();
    }

	
}