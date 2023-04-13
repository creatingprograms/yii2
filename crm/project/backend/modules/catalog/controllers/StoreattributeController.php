<?php

namespace backend\modules\catalog\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\catalog\models\StoreAttribute;
use backend\modules\catalog\models\StoreAttributeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\catalog\models\StoreAttributeGroup;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * StoreAttributeController implements the CRUD actions for StoreAttribute model.
 */
class StoreattributeController extends Controller
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
     * Lists all StoreAttribute models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreAttributeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new StoreAttribute();

        
        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isPost){
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/default/';
                    if(file_exists($model->param_icon)){
                        unlink($model->param_icon);
                    }
                    $model->param_icon = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->param_icon);
                }
                if($file = UploadedFile::getInstance($model, 'upload_image1')){
                    $dir = Yii::getAlias('@images').'/images/default/';
                    if(file_exists($model->imageFile)){
                        unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->param_icon);
                }
                if ($model->validate() && $model->save()) {
                    return $this->redirect('index');
                }
            }
        }
        $filter = [];
        $filter = StoreAttributeGroup::find()->all();
        $blocks = ArrayHelper::map($filter,'id','name');

        return $this->render('create', [
            'model' => $model,
            'filter' => $blocks,
        ]);
    }

    /**
     * Updates an existing StoreAttribute model.
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
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/default/';
                    if(file_exists($model->param_icon)){
                        unlink($model->param_icon);
                    }
                    $model->param_icon = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->param_icon);
                }
                if($file = UploadedFile::getInstance($model, 'upload_image1')){
                    $dir = Yii::getAlias('@images').'/images/default/';
                    if(file_exists($model->imageFile)){
                        unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->param_icon);
                }
                if ($model->validate() && $model->save()) {
                    return $this->redirect('index');
                }
            }
        }
        $filter = [];
        $filter = StoreAttributeGroup::find()->all();
        $blocks = ArrayHelper::map($filter,'id','name');

        return $this->render('update', [
            'model' => $model,
            'filter' => $blocks,
        ]);
    }

    /**
     * Deletes an existing StoreAttribute model.
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
     * Finds the StoreAttribute model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreAttribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreAttribute::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
