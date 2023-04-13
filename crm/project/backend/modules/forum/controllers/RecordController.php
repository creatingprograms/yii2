<?php

namespace backend\modules\forum\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\forum\models\Record;
use backend\modules\forum\models\RecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\modules\forum\models\Category;
use backend\modules\forum\models\Infoblock;
use yii\web\UploadedFile;

/**
 * RecordController implements the CRUD actions for Record model.
 */
class RecordController extends Controller
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
     * Lists all Record models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Record model.
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
     * Creates a new Record model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $countblocks = [];
        
        $model = new Record();

        
        if ($model->load(Yii::$app->request->post())) {
            
            if (Yii::$app->request->isPost) {
                $model->file = UploadedFile::getInstances($model, 'file');
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/';
                    if(file_exists($model->imageFile)){
                            unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->imageFile);
                }
                if ($model->upload() && $model->save()) {
                        // file is uploaded successfully
                        return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        $countblocks = count($model);
        $categories = Category::find()->all();
        $blocks = ArrayHelper::map($categories,'id','title');
        
        $records = Record::find()->all();
        $blocks2 = ArrayHelper::map($records,'id','title');
        
        $infoblock = Infoblock::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $blocks1 = ArrayHelper::map($infoblock,'id','title');
        
        return $this->render('create', [
            'model' => $model,
            'categories' => $blocks,
            'infoblocks' => $blocks1,
            'countblocks' => $countblocks,
            'records' => $blocks2,
        ]);
    }

    /**
     * Updates an existing Record model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $files1 = [];
		
        if ($model->load(Yii::$app->request->post())) {
            
            if (Yii::$app->request->isPost) {
                $model->file = UploadedFile::getInstances($model, 'file');
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    $dir = Yii::getAlias('@images').'/images/';
                    if(file_exists($model->imageFile)){
                            unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->imageFile);
                }
                if($model->file){
                    foreach ($model->file as $file) {
                            if(file_exists($file)){
                                    unlink($file);
                            }
                            $file->saveAs('uploads/files/' . $file);
                            $files = array_push($files1, $file);
                    }
                    $files = implode($files1, ',');

                    $model->allFile = $files;
                }
                if ($model->upload() && $model->save()) {
                        // file is uploaded successfully
                        return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        $categories = Category::find()->all();
        $blocks = ArrayHelper::map($categories,'id','title');

        $records = Record::find()->all();
        $blocks2 = ArrayHelper::map($records,'id','title');
        
        $infoblock = Infoblock::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $blocks1 = ArrayHelper::map($infoblock,'id','title');
        $all_file = explode(",", $model->allFile);
		foreach($all_file as $file){
			array_push($files1, Html::img("/admin/uploads/files/".$file));
		}
        return $this->render('update', [
            'model' => $model,
            'categories' => $blocks,
            'infoblocks' => $blocks1,
            'records' => $blocks2,
            'all_file' => $files1,
            //'countblocks' => $countblocks,
        ]);
    }

    /**
     * Deletes an existing Record model.
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
     * Finds the Record model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Record the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Record::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
