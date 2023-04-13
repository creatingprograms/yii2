<?php

namespace backend\modules\catalog\controllers;

use Yii;
use backend\modules\catalog\models\StoreAttributeGroup;
use backend\modules\catalog\models\StoreAttributeGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StoreAttributeGroupController implements the CRUD actions for StoreAttributeGroup model.
 */
class StoreattributegroupController extends Controller
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
     * Lists all StoreAttributeGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreAttributeGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreAttributeGroup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoreAttributeGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreAttributeGroup();

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isPost) {
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/';
                    if(file_exists($model->imageFile)){
                            unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->imageFile);
                }
                if ($model->save()) {
                    return $this->redirect('index');
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreAttributeGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isPost) {
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/';
                    if(file_exists($model->imageFile)){
                            unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->imageFile);
                }
                if ($model->save()) {
                    return $this->redirect('index');
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreAttributeGroup model.
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
     * Finds the StoreAttributeGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreAttributeGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreAttributeGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
