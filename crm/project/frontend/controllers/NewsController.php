<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\forum\models\Infoblock;
use backend\modules\forum\models\News;
use yii\data\ActiveDataProvider;

class NewsController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'news'],
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
    public function actionIndex() {
        
        $models = [];
        $models = News::find()->all();
        $title = 'Новости'; 
		$dataProvider = new ActiveDataProvider([
			'query' => News::find()->orderBy('id DESC'),
			'pagination' => [
				'pageSize' => 6,
			],
		]);
        
        return $this->render('index', [
           'models' => $models,
           'title' => $title,
		   'dataProvider' => $dataProvider
        ]);
    }
        
    public function actionView($slug)
    {
        $files = [];
        $all_news =[];
        
        $model = News::find()->where(['slug'=>$slug])->one();
        $files = explode(",", $model->allFile);
        $all_news = News::find()->limit(5)->all();
		//$index = News::nextOrPrev($model->id);
		$nextID = News::find()->where(['id'=>$model->id+1])->one();
		//$disableNext = ($nextID===null)?'disabled':null;
		$prevID = News::find()->where(['id'=>$model->id-1])->one();
		//$disablePrev = ($prevID===null)?'disabled':null;
        return $this->render('view', [
            'model' => $this->findModel($slug),
            'files' => $files,
            'all_news' => $all_news,
			'nextID' => !empty($nextID)? $nextID: '',
			'prevID' => !empty($prevID)? $prevID: '',
			
        ]);
    }
    protected function findModel($slug)
    {
        //die($slug);
        if (($model = News::findOne(['slug'=>$slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}