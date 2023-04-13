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
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\forum\models\Infoblock;
use backend\modules\forum\models\InfoblockItem;
use backend\models\Contacts;
use backend\models\Constructor;
use backend\models\Constructform;
use frontend\models\CalcForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
		$product = StoreAttributeValue::find()->limit(15)->all();
        $model = Staticpage::find()->where(['slug'=>'home'])->one();
        $info = Infoblock::find()->where(['id'=>4])->one();
        $model1 = new ContactForm();
		if ($model1->load(Yii::$app->request->post()) && $model1->validate()) {
			die('11111111');
			if ($model1->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Спасибо за ваше письмо. Мы свяжемся с вами в ближайшее время.');
			} else {
				Yii::$app->session->setFlash('error', 'Ошибка отправки почты.');
			}

			//return $this->refresh();
		} else {
			return $this->render('index', [
				'settings' => $settings,
				'model' => $model,
				'product' => $product,
				'info'=>$info,
				'model1' => $model1,
			]);
		}
    }  
	
    public function actionContact()
    {
        $model = Staticpage::find()->where(['slug'=>'contact'])->one();
        $settings = Settings::find()->all();
        \Yii::$app->view->title = $model->meta_title;
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $model->meta_description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $model->meta_keywords,
        ]);
        
        $model1 = new ContactForm();
        if ($model1->load(Yii::$app->request->post()) && $model1->validate()) {
                if ($model1->sendEmail(Yii::$app->params['adminEmail'])) {
                    Yii::$app->session->setFlash('success', 'Спасибо за ваше письмо. Мы свяжемся с вами в ближайшее время.');
                    $mail = new Constructform();
                    $mail->name = $model1->name;
                    $mail->phone = $model1->phone;
                    $mail->nabor1 = $model1->nabor1;
                    //$mail->created_at = $time->format('Y-m-d H:m:s');
                    $mail->save();
                    //return $this->render('index', compact('model', 'answer'));

                } else {
                        Yii::$app->session->setFlash('error', 'Ошибка отправки почты.');
                }

                return $this->refresh();
            }else{ 
                return $this->render('contact', [
				'settings' => $settings,
				'model' => $model,
                                'model1'=>$model1
                ]);
            }
    }
	
    public function actionAbout()
    {
        $model = Staticpage::find()->where(['slug'=>'about'])->one();
        $settings = Settings::find()->all();
        //Yii::$app->map->currentRequest->page_title = $model->meta_title;
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $model->meta_description,
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $model->meta_keywords,
        ]);
        return $this->render('about', [
				'settings' => $settings,
				'model' => $model,
            ]);
    }
    public function actionSendmail()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            //Yii::$app->session->setFlash('contactFormSubmitted');

            $success= ['success' => true];
            return json_encode($success);
        } else {
            $success= ['success' => false];
        }
                
        return json_encode($success);
    }
    
    public function actionView($slug)
    {
        $settings = Settings::find()->all();
        $action = Yii::$app->controller->action->id;
		$model = $this->findModel($slug);
		if(!empty($model)){
			return $this->render('view', [
				'model' => $model,
				'settings' => $settings,
				'action' => $action,
			]);
		}  else {
			$model = Staticpage::find()->where(['slug'=>'error'])->one();
			return $this->render('error', [
				'model' => $model,
			]);
		}
    }
	
    public function actionError()
    {
		$exception = Yii::$app->errorHandler->exception;
		if ($exception !== null) {
			if ($exception->statusCode == 404)
				return $this->render('error', ['exception' => $exception]);
		}
	}
	
    public function actionSale()
    {
        $model = Staticpage::find()->where(['slug'=>'sale'])->one();
		$records = StoreProduct::find()->all();
		
		return $this->render('sale', [
			'model' => $model,
			'records' => $records
		]);
		
	}
	
    protected function findModel($slug)
    {
        if (($model = Staticpage::findOne(['slug'=>$slug])) !== null) {
            return $model;
        }
        return false;
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionConfidentiality()
    {
        $model = Staticpage::find()->where(['slug'=>'confidentiality'])->one();
		
		return $this->render('confidentiality', [
			'model' => $model
			]);
	
	}
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    public function actionAdmin() {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'shedevrxxx@inbox.ru';
            $user->setPassword('admin234');
            $user->status = 10;
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }
}
