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
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\User;
use backend\models\Settings;
use backend\models\Staticpage;
use backend\models\Portfolio;
use backend\modules\catalog\models\StoreCategory;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreProductSearch;
use backend\modules\catalog\models\StoreAttributeGroup;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class ServicesController extends Controller
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
        $settings = Settings::find()->all();
        $model = StoreProduct::find()->all();
        $cat = [];
        $cat = StoreCategory::find()->where(['<>', 'parent_id', 0])->all();
        return $this->render('index', [
            'settings' => $settings,
            'model' => $model,
            'cat' => $cat
        ]);
    }

    public function actionStock()
    {
        $settings = Settings::find()->all();
        $model = StoreAttributeValue::find()->where(['not', ['option_value'=>null]])->all();
        return $this->render('index', [
            'settings' => $settings,
            'model' => $model,
        ]);
    }
	
    public function actionView($slug)
    {
        $settings = Settings::find()->all();
        $model = $this->findModel($slug);
        $model = $this->findModel($slug);
		if(!empty($model->meta_title)){
			Yii::$app->view->title = $model->meta_title;
			$titl = $model->meta_title;
		}else{
			Yii::$app->view->title = $model->title;
			$titl = $model->title;
		}
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => !empty($model->meta_description)?$model->meta_description : $model->description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $model->meta_keywords,
        ]);
		//if(StoreAttributeValue::findOne(['slug'=>$slug]) == null){
		if(StoreProduct::findOne(['slug'=>$slug]) == null){
                        $filters = StoreAttributeGroup::find()->all();
                        $searchModel = new StoreProductSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->pagination->pageSize=1;
                    
			$records = StoreProduct::find()->where(['category_id'=>$model->id])->all();
			//$cats = StoreCategory::find()->where(['parent_id'=>$model->id])->all();
			return $this->render('view', [
				'model' => $model,
				'records' => $records,
				'cats' => $cats,
				'settings' => $settings,
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'filters' => $filters,
				'titl' => $titl
			]);
		}else{
			$all_files = explode(",", $model->allFile);
			$catsis = StoreCategory::find()->where(['parent_id'=>0])->all();
                        $review = \backend\models\Review::find()->where(['product_id'=>$model->id])->all();
			return $this->render('product', [
                            'model' => $model,
                            'settings' => $settings,
                            'all_files' => $all_files,
                            'catsis' => $catsis,
                            'reviews' => $review,
							'titl' => $titl
			]);
		}
        
    }
    public function search($params)
    {
        $query = StoreProduct::find();

           $query->andFilterWhere([
            'category_id' => $this->category_id,
            'sku' => $this->sku,

        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }
    protected function findModel($slug)
    {
        //die($slug);
        if (($model = StoreCategory::findOne(['slug'=>$slug])) !== null) {
            return $model;
        //}elseif(($model = StoreAttributeValue::findOne(['slug'=>$slug])) !== null){ //для подтоваров главных
        }elseif(($model = StoreProduct::findOne(['slug'=>$slug])) !== null){
            return $model;
		}

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
