<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreProducerItem;

/**
 * Site controller
 */
class CollectionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $slides = StoreProducer::find()->orderBy('sort')->all();
        return $this->render('index', ['slides'=>$slides]);
    }

    public function actionView($slug)
    {
        $model = $this->findModel($slug);
        $arr = [];
        $records = StoreProducerItem::find()->where(['producer_id'=>$model->id])->all();
        $products = StoreProduct::find()->where(['producer_id'=>$model->id])->all();
		foreach($products as $product){
			if(count($arr) != 5){
				$params = StoreAttributeValue::find()->where(['product_id'=>$product->id])->all();
				foreach($params as $param){
					if(count($arr) != 5){
						array_push($arr, $param);
					}
				}
			}
		
		}
        
        return $this->render('view', [
            'model' => $model,
            'records' => $records,
			'products' => $arr
        ]);
    }
    protected function findModel($slug)
    {
        //die($slug);
        if (($model = StoreProducer::findOne(['slug'=>$slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
