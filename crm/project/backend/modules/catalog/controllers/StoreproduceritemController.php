<?php

namespace backend\modules\catalog\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\catalog\models\StoreProducerItem;
use backend\modules\catalog\models\StoreProducerItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use backend\modules\forum\models\Infoblock;
use backend\modules\catalog\models\StoreProducer;

/**
 * StoreproduceritemController implements the CRUD actions for StoreProducerItem model.
 */
class StoreproduceritemController extends Controller
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
     * Lists all StoreProducerItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreProducerItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $files1 = [];
        
        $model = new StoreProducerItem();

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isPost){
                $dir = Yii::getAlias('@images').'/images/';
                if($file = UploadedFile::getInstance($model, 'upload_image')){
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
        $producer = [];
        $producer = StoreProducer::find()->all();
        $blocks = ArrayHelper::map($producer,'id','title');

        return $this->render('create', [
            'model' => $model,
            'producer' => $blocks,
        ]);
    }

    /**
     * Updates an existing StoreProducerItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
		
            if(Yii::$app->request->isPost){
                $dir = Yii::getAlias('@images').'/images/';
                if($file = UploadedFile::getInstance($model, 'upload_image')){
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
        $producer = [];
        $producer = StoreProducer::find()->all();
        $blocks = ArrayHelper::map($producer,'id','title');
        return $this->render('update', [
            'model' => $model,
            'producer' => $blocks,
        ]);
    }

    /**
     * Deletes an existing StoreProducerItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StoreProducerItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreProducerItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreProducerItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
