<?php

namespace backend\modules\catalog\controllers;

use Yii;
use yii\helpers\Html;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\modules\forum\models\Category;
use backend\modules\forum\models\Infoblock;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreCategory;
use yii\web\UploadedFile;
use backend\modules\catalog\models\StoreAttribute;
use backend\modules\catalog\models\StoreAttributeGroup;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreAttributeSearch;
use backend\modules\catalog\models\StoreProductLinkType;
use DateTime;
use DateTimeZone;

/**
 * StoreproductController implements the CRUD actions for StoreProduct model.
 */
class StoreproductController extends Controller
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
     * Lists all StoreProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new StoreProduct();

		
        if ($model->load(Yii::$app->request->post())) {
            
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
                    $files1 = [];
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
                if ($model->upload() && $model->save()) {
				
					$model = $this->findModel($model->id);
					
                    if(!empty($model->parent_id)){

                        $all_filters = explode(",", $model->parent_id);

                        $time = new DateTime('now', new DateTimeZone('UTC'));
                        foreach($all_filters as $filter){
                            $attr_value = StoreAttributeValue::find()->where(['product_id'=>$model->id])->andWhere(['attribute_id'=>$filter])->one();
                            if(empty($attr_value)) {
                                //die($attr_value);
                                $attr = new StoreAttributeValue();
                                $attr->product_id = $model->id;
                                $attr->attribute_id = $filter;
                                $attr->create_time = $time->format('Y-m-d H:m:s');
                                $attr->save();
                            }
                        }
                    }else{
                        $attr_values = StoreAttributeValue::find()->where(['product_id'=>$model->id])->all();
                        foreach($attr_values as $attr_value){
                            $val = StoreAttributeValue::findOne($attr_value->id);
                            $val->delete();
                        }
                    }
                    
                    // file is uploaded successfully
                    return $this->redirect(['update', 'id'=>$model->id]);
                }
            }
        }
        
        $array = ['0' => '--Нет--'];
        $categories = StoreCategory::find()->all();
		$cats = [];
		foreach($categories as $cat){
			$parent = StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->parent_id;
			$parentt = StoreCategory::find()->where(['id'=>$parent])->one();
			if($parentt->parent_id == 0){
				$par = StoreCategory::find()->where(['id'=>$parentt->id])->one()->title;
				if(!empty($par)){
					$data_cat = $par.'->'.StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title.'->'.$cat->title;
				}elseif(!empty(StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title)){
					$data_cat = StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title.'->'.$cat->title;
				}else{
					$data_cat = $cat->title;
				}
				array_push($cats, ['id' => $cat->id, 'title' => $data_cat]);
			}else{
				array_push($cats, ['id' => $cat->id, 'title' => !empty(StoreCategory::find()->where(['id'=>$cat->parent_id])->one())? StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title.'->'.$cat->title : $cat->title]);
			}
		}
        $blocks = ArrayHelper::map($cats,'id','title');
        $data = ($array+$blocks);
        
        $records = StoreProduct::find()->all();
        $blocks2 = ArrayHelper::map($records,'id','title');
        
        $infoblock = Infoblock::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $blocks1 = ArrayHelper::map($infoblock,'id','title');
        
        $producer =  ArrayHelper::map(StoreProducer::find()->all(),'id','title');
        $data1 = ($array+$producer);
        $searchModel = new StoreProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel1 = new StoreAttributeSearch();
        $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
        
        
        $filter = StoreAttributeValue::find()->all();
        $filters1 = StoreAttributeGroup::find()->all();
        $blocks3 = ArrayHelper::map($filter,'id','attribute_id');
        $blocks4 = ArrayHelper::map($filters1,'id','name');
        $data2 = ($array+$blocks4);
        $filter_item = StoreAttributeValue::find()->where(['product_id'=>$model->id])->all();
        $blocks5 = ArrayHelper::map($filter_item,'id','attribute_id');
        
        $link_type = ArrayHelper::map(StoreProductLinkType::find()->all(),'id','title');
		
		
        return $this->render('create', [
            'model' => $model,
            'categories' => $data,
            'infoblocks' => $blocks1,
            'records' => $blocks2,
            'producer' => $data1,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel1' => $searchModel1,
            'dataProvider1' => $dataProvider1,
            'filters' => $blocks3,
            'filters1' => $data2,
            'link_type' => $link_type,
            'filter_item' => !empty($blocks5[0])? $blocks5: '',
            'filter_item1' => $filter_item,
        ]);
    }

    /**
     * Updates an existing StoreProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $files1 = [];
        $blocks5 = [];
        
        if ($model->load(Yii::$app->request->post())) {
            
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
                    $files1 = [];
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
                if ($model->upload() && $model->save()) {
					//$old_attr = StoreAttributeValue::find()->where(['product_id'=>$model->id])->all();
                    //if(!empty($old_attr) && $old_attr != []){
                        //$all_filters = explode(",", $model->parent_id);
                        //$attr_values1 = StoreAttributeValue::find()->where(['product_id'=>$model->id])->select('attribute_id')->asArray()->column();

                        //$time = new DateTime('now', new DateTimeZone('UTC'));
                       // if($all_filters != $attr_values1){
                            //$attr_values2 = StoreAttributeValue::find()->where(['product_id'=>$model->id])->all();
                            //die($attr_values2[0]->id);
                            //if($attr_values2 != []){
                                //foreach($attr_values2 as $attr_value){
                                    //$val = StoreAttributeValue::findOne($attr_value->id);
                                    //$val->delete();
                                //}
                            //}
                            //foreach($all_filters as $filter){
                                //$attr_value = StoreAttributeValue::find()->where(['product_id'=>$model->id])->andWhere(['attribute_id'=>$filter])->one();
                                //if(empty($attr_value)) {
                                    //die($attr_value);
                                    //$attr = new StoreAttributeValue();
                                    //$attr->product_id = $model->id;
                                    //$attr->attribute_id = $filter;
                                    //$attr->create_time = $time->format('Y-m-d H:m:s');
                                    //$attr->save();
                                //}
                            //}
                        //}
                            
                        return $this->redirect('index');
                    }else{
                        $attr_values = StoreAttributeValue::find()->where(['product_id'=>$model->id])->all();
                        if($attr_values!=[]){
                            foreach($attr_values as $attr_value){
                                $val = StoreAttributeValue::findOne($attr_value->id);
                                $val->delete();
                            }
                        }
                    }
                        // file is uploaded successfully
                    return $this->redirect('index');
            }
        }
        $array = ['0' => '--Нет--'];
        $categories = StoreCategory::find()->all();
		$cats = [];
		foreach($categories as $cat){
			$parent = StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->parent_id;
			$parentt = StoreCategory::find()->where(['id'=>$parent])->one();
			if($parentt->parent_id == 0){
				$par = StoreCategory::find()->where(['id'=>$parentt->id])->one()->title;
				if(!empty($par)){
					$data_cat = $par.'->'.StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title.'->'.$cat->title;
				}elseif(!empty(StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title)){
					$data_cat = StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title.'->'.$cat->title;
				}else{
					$data_cat = $cat->title;
				}
				array_push($cats, ['id' => $cat->id, 'title' => $data_cat]);
			}else{
				array_push($cats, ['id' => $cat->id, 'title' => !empty(StoreCategory::find()->where(['id'=>$cat->parent_id])->one())? StoreCategory::find()->where(['id'=>$cat->parent_id])->one()->title.'->'.$cat->title : $cat->title]);
			}
		}
        $blocks = ArrayHelper::map($cats,'id','title');
        $data = ($array+$blocks);
        
        $records = StoreProduct::find()->all();
        $blocks2 = ArrayHelper::map($records,'id','title');
        
        $infoblock = Infoblock::find()->all();
            // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $blocks1 = ArrayHelper::map($infoblock,'id','title');
        
        $producer =  ArrayHelper::map(StoreProducer::find()->all(),'id','title');
        $data1 = ($array+$producer);
        
        $searchModel = new StoreProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $searchModel1 = new StoreAttributeSearch();
        $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
        
        $filter = StoreAttributeValue::find()->all();
        $filters1 = StoreAttributeGroup::find()->all();
        $blocks3 = ArrayHelper::map($filter,'id','attribute_id');
        $blocks4 = ArrayHelper::map($filters1,'id','name');
        $data2 = ($array+$blocks4);
        $filter_item = StoreAttributeValue::find()->where(['product_id'=>$model->id])->all();
        $blocks5 = ArrayHelper::map($filter_item,'id','attribute_id');
        
        $all_file = explode(",", $model->allFile);
        foreach($all_file as $file){
            array_push($files1, !empty($file)? Html::img("/uploads/images/".$file): '');
        }
        
        $link_type =  ArrayHelper::map(StoreProductLinkType::find()->all(),'id','title');
        
        return $this->render('update', [
            'model' => $model,
            'categories' => $data,
            'infoblocks' => $blocks1,
            'records' => $blocks2,
            'producer' => $data1,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel1' => $searchModel1,
            'dataProvider1' => $dataProvider1,
            'filters' => $blocks3,
            'filters1' => $data2,
            'all_file' => $files1[0] != ''? $files1: '',
            'link_type' => $link_type,
            'filter_item' => $blocks5 != [] ? $blocks5: '',
            'filter_item1' => $filter_item,
        ]);
    }

    /**
     * Deletes an existing StoreProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){
			$olds_attr = StoreAttributeValue::find()->where(['product_id'=>$id])->all();
			foreach($olds_attr as $old_attr){
				$old_attr->delete();
			}
		}

        return $this->redirect(['index']);
    }

    /**
     * Finds the StoreProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
