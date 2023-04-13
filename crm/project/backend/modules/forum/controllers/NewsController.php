<?php

namespace backend\modules\forum\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\forum\models\News;
use backend\modules\forum\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\forum\models\Infoblock;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $countblocks = [];
        
        $model = new News();
		$files1 = [];

        if ($model->load(Yii::$app->request->post())) {
            
            
            if (Yii::$app->request->isPost) {
                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                $model->docFiles = UploadedFile::getInstances($model, 'docFiles');
				$dir = Yii::getAlias('@images').'/images/';
				if($file = UploadedFile::getInstance($model, 'upload_image')){
					if(file_exists($model->imageFile)){
							unlink($model->imageFile);
					}
					$model->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
					$file->saveAs($dir.$model->imageFile);
				}
				if($model->imageFiles){
						//$dir = '/admin'.Yii::getAlias('@images').'/files/';]

						//$filess = explode(',', $model->allFile);
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
				if($model->docFiles){
						//$dir = '/admin'.Yii::getAlias('@images').'/files/';]

						//$filess = explode(',', $model->allFile);
						foreach ($model->docFiles as $fil) {
								if(file_exists($fil)){
										unlink($fil);
								}
								$fil->saveAs('/uploads/images/' . $fil);
								$files = array_push($files1, $fil);
						}
						$files2 = implode($files3, ',');

						$model->docFile = $files2;
				}
                if ($model->upload() && $model->save()) {
                        // file is uploaded successfully
                        return $this->redirect('index');
                }
            }
        }
        $countblocks = count($model);
        $infoblock = Infoblock::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $blocks = ArrayHelper::map($infoblock,'id','title');
        
        return $this->render('create', [
            'model' => $model,
            'infoblocks' => $blocks,
            'countblocks' => $countblocks,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $files1 = [];
        $files3 = [];
        if ($model->load(Yii::$app->request->post())) {
            
                            $dir1 = Yii::getAlias('@images').'/files/';
            if (Yii::$app->request->isPost) {
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
                            //$dir = '/admin'.Yii::getAlias('@images').'/files/';]

                            //$filess = explode(',', $model->allFile);
                            foreach ($model->imageFiles as $file) {
                                    if(file_exists($file)){
                                            unlink($file);
                                    }
                                    $file->saveAs($dir.$file);
                                    $files = array_push($files1, $file);
                            }
                            $files = implode($files1, ',');

                            $model->allFile = $files;
                    }
                $model->docFiles = UploadedFile::getInstances($model, 'docFiles');
                    if($model->docFiles){
                            //$dir = '/admin'.Yii::getAlias('@images').'/files/';]

                            //$filess = explode(',', $model->allFile);
							//die($model->docFiles[1]);
                            foreach ($model->docFiles as $fil) {
                                    if(file_exists($fil)){
                                            unlink($fil);
                                    }
                                    $fil->saveAs($dir1 . $fil);
                                    $files = array_push($files3, $fil);
                            }
                            $files2 = implode($files3, ',');

                            $model->docFile = $files2;
                    }
                if ($model->upload() && $model->save()) {
                        // file is uploaded successfully
                        return $this->redirect('index');
                }
            }
            
        }
        $infoblock = Infoblock::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $blocks = ArrayHelper::map($infoblock,'id','title');
        $all_file = explode(",", $model->allFile);
		foreach($all_file as $file){
			array_push($files1, Html::img("/uploads/images/".$file));
		}
        
        
        /*if (isset($model->allFile)) {
            if ($model->validate()) {
                $files = UploadedFile::getInstances($model, 'allFile');
                if ($files !== null)
                    foreach ($files as $file) {
                        $name = $file->tempName;
                    }
            }
        }*/
        
        
        return $this->render('update', [
            'model' => $model,
            'infoblocks' => $blocks,
			'all_file' => $files1,
			'doc_file' => $files3,
        ]);
    }

    public function actionLoad()
    {
        $model = new LoadModelPhotoForm();

        $this->renderPartial('create_multi', array('model' => $model));
    }
    /**
     * Deletes an existing News model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
