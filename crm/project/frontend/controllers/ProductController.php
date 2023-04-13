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

/**
 * Site controller
 */
class StoreController extends Controller
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
        $model = StoreCategory::find()->where(['parent_id'=>null])->all();
        return $this->render('index', [
            'settings' => $settings,
            'model' => $model,
        ]);
    }

    public function actionView($slug)
    {
        $settings = Settings::find()->all();
        $model = $this->findModel($slug);
        if(!empty($model->parent_id)){
            $records = StoreProduct::find()->where(['category_id'=>$model->id])->all();
			return $this->render('record', [
				'model' => $model,
				'records' => $records,
				'settings' => $settings,
			]);
        }else{
            $records = StoreCategory::find()->where(['parent_id'=>$model->id])->all();
			return $this->render('view', [
				'model' => $model,
				'records' => $records,
				'settings' => $settings,
			]);
        }
        
    }
    protected function findModel($slug)
    {
        //die($slug);
        if ($model = StoreCategory::findOne(['slug'=>$slug]) !== null) {
            return $model;
        }elseif($model = StoreProduct::findOne(['slug'=>$slug]) !== null){
            return $model;
		}

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
