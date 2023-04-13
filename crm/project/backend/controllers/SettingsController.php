<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\web\Controller;
use backend\models\Settings;
use backend\models\SettingsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use DateTime;
use DateTimeZone;

class SettingsController extends Controller
{
    public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => false,
						'roles' => ['?'],
						'denyCallback' => function($rule, $action) {
							return $this->redirect(Url::toRoute(['/site/login']));
						}
					],
					[
						'allow' => false,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							/** @var User $user */
							$user = Yii::$app->user->getIdentity();
							return $user->isSub() || $user->isUser() || $user->isManager();
						}
					],
					[
						'actions' => [],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							/** @var User $user */
							$user = Yii::$app->user->getIdentity();
							return $user->isAdmin();
						}
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $model = Settings::find()->where(['param_name' => 'logo'])->one();
        $model1 = Settings::find()->where(['param_name' => 'defaultImage'])->one();
        $settings = Settings::find()->indexBy('id')->all();
        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $time = new DateTime('now', new DateTimeZone('UTC'));
                $setting->update_time = $time->format('Y-m-d H:m:s');
                if($setting->param_name == 'logo' && $file = UploadedFile::getInstance($setting, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/default/';
                    if(file_exists($setting->param_value)){
                        unlink($setting->param_value);
                    }
                    $setting->param_value = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$setting->param_value);
                }elseif($setting->param_name == 'defaultImage' && $file = UploadedFile::getInstance($setting, 'upload_image1')){
                    $dir = Yii::getAlias('@images').'/images/default/';
                    if(file_exists($setting->param_value)){
                        unlink($setting->param_value);
                    }
                    $setting->param_value = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                            
                    $file->saveAs($dir.$setting->param_value);
                }
                $setting->save(false);
            }
            return $this->redirect('/for_admin/settings');
        }
        return $this->render('index', ['settings' => $settings, 'model' => $model, 'model1' => $model1]);
    }
    public function actionCreate()
    {
        $model = new Settings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
     public function actionLoad()
    {
        $model = new LoadModelPhotoForm();

        $this->renderPartial('create_multi', array('model' => $model));
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Infoblock::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}