<?php

namespace backend\modules\catalog\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\catalog\models\StoreCategory;
use backend\modules\catalog\models\StoreCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * StorecategoryController implements the CRUD actions for StoreCategory model.
 */
class StorecategoryController extends Controller
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
     * Lists all StoreCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreCategory model.
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
     * Creates a new StoreCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $categories = [];
        //$categories = StoreCategory::find()->where(['parent_id'=>0])->all();
        $categories = StoreCategory::find()->all();
		$cats = [];
		foreach($categories as $cat){
			array_push($cats, ['id' => $cat->id, 'title' => !empty(StoreCategory::find()->where(['id'=>$cat->parent_id])->one())? StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title.'->'.$cat->title : $cat->title]);
		}
        $array = ['0' => '--Нет--'];
        $blocks = ArrayHelper::map($cats, 'id', 'title');
        $data = ($array+$blocks);
        $model = new StoreCategory();

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
                if ($model->attribut() && $model->save()) {
                    return $this->redirect('index');
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $data,
        ]);
    }

    /**
     * Updates an existing StoreCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $categories = [];
        $categories = StoreCategory::find()->all();
		$cats = [];
		foreach($categories as $cat){
			array_push($cats, ['id' => $cat->id, 'title' => !empty(StoreCategory::find()->where(['id'=>$cat->parent_id])->one())? StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title.'->'.$cat->title : $cat->title]);
		}
        $array = ['0' => '--Нет--'];
        $blocks = ArrayHelper::map($cats,'id','title');
        $data = ($array+$blocks);
        
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
                if ($model->attribut() && $model->save()) {
                    return $this->redirect('index');
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $data,
        ]);
    }

    /**
     * Deletes an existing StoreCategory model.
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
     * Finds the StoreCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
