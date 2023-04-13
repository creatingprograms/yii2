<?php

namespace backend\modules\catalog\controllers;

use Yii;
use yii\base\Model;
use yii\web\Controller;
use backend\modules\catalog\models\StoreSettings;
use backend\modules\catalog\models\StoreSettingsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use DateTime;
use DateTimeZone;

/**
 * StoresettingsController implements the CRUD actions for StoreSettings model.
 */
class StoresettingsController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all StoreSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = StoreSettings::find()->where(['param_name' => 'defaultImage'])->one();
        $settings = StoreSettings::find()->indexBy('id')->all();
        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $time = new DateTime('now', new DateTimeZone('UTC'));
                $setting->update_time = $time->format('Y-m-d H:m:s');
                if($setting->param_name == 'defaultImage' && $file = UploadedFile::getInstance($setting, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/default/';
                    if(file_exists($setting->param_value)){
                        unlink($setting->param_value);
                    }
                    $setting->param_value = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                            
                    $file->saveAs($dir.$setting->param_value);
                }
                $setting->save(false);
            }
            return $this->redirect('/sun_admin/settings');
        }
        return $this->render('index', ['settings' => $settings, 'model' => $model]);
    }
    public function actionCreate()
    {
        $model = new StoreSettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreSettings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Finds the StoreSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreSettings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
