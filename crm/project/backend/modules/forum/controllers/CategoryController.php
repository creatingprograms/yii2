<?php

namespace backend\modules\forum\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\forum\models\Category;
use backend\modules\forum\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $categories = [];
        $array = ['0' => '--Нет--'];
        $categories = Category::find()->all();
        $blocks = ArrayHelper::map($categories,'id','title');
        $data = ($array+$blocks);
        $model = new Category();
        
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
        //die($blocks);
        return $this->render('create', [
            'model' => $model,
            'categories' => $data,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $categories = [];
        $array = ['0' => '--Нет--'];
        $categories = Category::find()->all();
        $blocks = ArrayHelper::map($categories,'id','title');
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
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
