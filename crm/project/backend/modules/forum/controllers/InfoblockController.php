<?php

namespace backend\modules\forum\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\forum\models\Infoblock;
use backend\modules\forum\models\InfoblockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\forum\models\Record;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use DateTime;
use DateTimeZone;

/**
 * InfoblockController implements the CRUD actions for Infoblock model.
 */
class InfoblockController extends Controller
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
     * Lists all Infoblock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoblockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Infoblock model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCreate()
    {
        $model = new Infoblock();
        
        $records = Record::find()->all();
        $blocks = ArrayHelper::map($records,'id','title');
        
        $time = new DateTime('now', new DateTimeZone('UTC'));
        $model->created_at = $time->format('Y-m-d H:m:s');
        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isPost){
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/';
                    if(file_exists($model->imageFile)){
                            unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->imageFile);
                }
                if ($model->validate() && $model->save()) {
                        return $this->redirect('index');
                }
                if ($model->upload()) {
                    return $this->redirect('index');
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'records' => $blocks,
        ]);
    }

    /**
     * Updates an existing Infoblock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $records = Record::find()->all();
        $blocks = ArrayHelper::map($records,'id','title');
        
        if ($model->load(Yii::$app->request->post())) {
		
            if(Yii::$app->request->isPost){
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/';
                    if(file_exists($model->imageFile)){
                            unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->imageFile);
                }
                if ($model->validate() && $model->save()) {
                        return $this->redirect('index');
                }
            }
		}
        return $this->render('update', [
            'model' => $model,
            'records' => $blocks,
        ]);
    }

    /**
     * Deletes an existing Infoblock model.
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
     * Finds the Infoblock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Infoblock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Infoblock::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
