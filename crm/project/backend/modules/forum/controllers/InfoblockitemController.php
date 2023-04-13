<?php

namespace backend\modules\forum\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\forum\models\InfoblockItem;
use backend\modules\forum\models\InfoblockItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use backend\modules\forum\models\Infoblock;

/**
 * InfoblockItemController implements the CRUD actions for InfoblockItem model.
 */
class InfoblockitemController extends Controller
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
     * Lists all InfoblockItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoblockItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new InfoblockItem();
        
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

        $infoblock = Infoblock::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $blocks1 = ArrayHelper::map($infoblock,'id','title');
        
        return $this->render('create', [
            'model' => $model,
            'infoblocks' => $blocks1,
        ]);
    }

    /**
     * Updates an existing InfoblockItem model.
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
		
            if(Yii::$app->request->isPost){
                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                $dir = Yii::getAlias('@images').'/images/';
                if($file = UploadedFile::getInstance($model, 'upload_image')){
                    if(file_exists($model->imageFile)){
                            unlink($model->imageFile);
                    }
                    $model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
                    $file->saveAs($dir.$model->imageFile);
                }
                if($model->imageFiles){
                        foreach ($model->imageFiles as $file) {
                                if(file_exists($file)){
                                        unlink($file);
                                }
                                $file->saveAs($dir . $file);
                                $files = array_push($files1, $file);
                        }
                        $files = implode($files1, ',');

                        $model->allFile = $files;
                }
                if ($model->validate() && $model->save()) {
                        return $this->redirect('index');
                }
            }
        }
        $infoblock = Infoblock::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $blocks1 = ArrayHelper::map($infoblock,'id','title');

        $all_file = explode(",", $model->allFile);
		foreach($all_file as $file){
			array_push($files1, Html::img("/uploads/images/".$file));
		}
                
        return $this->render('update', [
            'model' => $model,
            'infoblocks' => $blocks1,
            'all_file' => $files1,
        ]);
    }

    /**
     * Deletes an existing InfoblockItem model.
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
     * Finds the InfoblockItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InfoblockItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InfoblockItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
