<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Menuitem;
use backend\models\Portfolio;
use backend\models\Staticpage;
use backend\models\Constructor;
use backend\modules\forum\models\Category;
use backend\modules\catalog\models\StoreCategory;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreAttribute;
use backend\modules\catalog\models\StoreAttributeGroup;
use yii\web\UploadedFile;
use DateTime;
use DateTimeZone;
/**
 * MenuitemController implements the CRUD actions for Menuitem model.
 */
class AjaxController extends Controller
{
    
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
    
    public function actionMenu()
    {
        //if(\Yii::$app->request->post('dataname') == '/portfolio'){
            //$data2 = ['/'=>'--Не выбрано--', ''=>'Все портфолио'];
            //$data1 = Portfolio::find()->select(['title', 'slug'])->indexBy('slug')->column();
            //$data = array_merge($data2, $data1);
        //}
		if(\Yii::$app->request->post('dataname') == '/store'){
            $data2 = ['/'=>'--Не выбрано--', ''=>'Все услуги'];
            $data1 = StoreCategory::find()->select(['title', 'slug'])->indexBy('slug')->column();
            $data = array_merge($data2, $data1);
        }elseif(\Yii::$app->request->post('dataname') == '/collection'){
            $data2 = ['/'=>'--Не выбрано--', ''=>'Все коллекции'];
            $data1 = StoreProducer::find()->select(['title', 'slug'])->indexBy('slug')->column();
            $data = array_merge($data2, $data1);
        }elseif(\Yii::$app->request->post('dataname') == '/store'){
            $data2 = ['/'=>'--Не выбрано--', ''=>'Все категории'];
            $data1 = StoreCategory::find()->select(['title', 'slug'])->indexBy('slug')->column();
            $data = array_merge($data2, $data1);
        }elseif(\Yii::$app->request->post('dataname') == '/'){
            $data2 = ['/'=>'--Не выбрано--'];
            $data1 = Staticpage::find()->select(['title_short', 'slug'])->indexBy('slug')->column();
            $data = array_merge($data2, $data1);
        }else{
            $data = ['/'=>'--Не выбрано--', ''=>'Все Новости'];
        }
        $res = \Yii::$app->getResponse();
        $res->format = \yii\web\Response::FORMAT_JSON;
        $res->data = $data;
        $res->send();
    }
    
    //вариант фильтров присваемый если запись уже существует, то при выборе можно писать связи фильтр-товар прям здесь в таблицу связей
    public function actionFilter()
    {
        
        $data2 = ['/'=>'--Не выбрано--', ''=>'Все портфолио'];
        //print_r(\Yii::$app->request->post('dataname'));
        $data1 = Portfolio::find()->select(['title', 'slug'])->indexBy('slug')->column();
        $data = array_merge($data2, $data1);
        //$res = \Yii::$app->getResponse();
        //$res->format = \yii\web\Response::FORMAT_JSON;
        //$res->data = $data;
        //$res->send();
        
        return $this->renderAjax('filter', [
            'filters' => \Yii::$app->request->post('data'),
        ]);
    }

     
    // AJAX ЗАГРУЗКА
    public function actionAttribute()
    {
        $file = $_FILES;
		$data = Yii::$app->request->post();
        
        $attribut = StoreAttribute::find()->where(['title'=>$data['StoreProduct']['value_filtr']])->one();
        if(!isset($attribut)){
            $model1 = new StoreAttribute();
            $model1->title = $data['StoreProduct']['value_filtr'];
            $model1->group_id = $data['StoreProduct']['attr'];
            $model1->save();
        }else{
            $model1 = $attribut;
        }
        $title = StoreAttributeGroup::find()->where(['id'=>$data['StoreProduct']['attr']])->one()->name;
        $model = new StoreAttributeValue();
		$model->attribute_id = $model1->id;
		$model->product_id = $data['StoreProduct']['product'];
		$model->string_value = $data['StoreProduct']['value_filtr'];
		$model->text_value = $title;
		$time = new DateTime('now', new DateTimeZone('UTC'));
		$model->create_time = $time->format('Y-m-d H:m:s');
		
		if($file1 = UploadedFile::getInstanceByName('StoreProduct[image_prod]')){
			$dir = Yii::getAlias('@images').'/images/';
			if(file_exists($model->string_value)){
				unlink($model->string_value);
			}
			$model->string_value = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file1->extension;
			$file1->saveAs($dir.$model->string_value);
		}
		if ($model->validate() && $model->save()) {
			$products = StoreAttributeValue::find()->where(['product_id'=>$model->product_id])->all();
			$res = \Yii::$app->getResponse();	
			$res->format = \yii\web\Response::FORMAT_JSON;
			$res->data = $products;
			$res->send();
		}
    }
	
	public function actionCalculation(){
		$data = Yii::$app->request->post();
                $const11 = [];
                $const22 = [];
                $const33 = [];
                $const44 = [];
                $const = [];
		$construct = Constructor::find()->where(['id'=>$data['id']])->one();
                $const = Constructor::find()->where(['parent_id'=>$construct->id])->all();
                $model = $data;
                if(count($const) == '3'){
                    $const1 = Constructor::find()->where(['parent_id'=>$const[0]->id])->all();
                    $const2 = Constructor::find()->where(['parent_id'=>$const[1]->id])->all();
                    $const3 = Constructor::find()->where(['parent_id'=>$const[2]->id])->all();
                    $const1_one = Constructor::find()->where(['parent_id'=>$const[0]->id])->one()->title;
                    $const2_one = Constructor::find()->where(['parent_id'=>$const[1]->id])->one()->title;
                    $const3_one = Constructor::find()->where(['parent_id'=>$const[2]->id])->one()->title;
                    $price = $construct->price;
                    $title1 = $const[0]->title;
                    $title2 = $const[1]->title;
                    $title3 = $const[2]->title;
                    $idc = $data['id'];
                    $idc1 = $data['id'].'1';
                    $idc2 = $data['id'].'2';
                    $idc3 = $data['id'].'3';
                    foreach ($const1 as $c){
                        array_push($const11, 
                        "<div class='selective-item' col='$idc1'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c->title</span><span class='puck-select__price'>$c->price</span>
                            </div>
                        </div>");
                    }
                    $const111 = implode($const11);
                    foreach ($const2 as $c2){
                        array_push($const22, 
                        "<div class='selective-item' col='$idc2'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c2->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c2->title</span><span class='puck-select__price'>$c2->price</span>
                            </div>
                        </div>");
                    }
                    $const222 = implode($const22);
                    foreach ($const3 as $c3){
                        array_push($const33, 
                        "<div class='selective-item' col='$idc3'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c3->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c3->title</span><span class='puck-select__price'>$c3->price</span>
                            </div>
                        </div>");
                    }
                    $const333 = implode($const33);


                    $model = "<div class='col col--lg-4 parent_col' col='$idc'><div class='calc-item'><div class='calc-item__img'><button class='calc-item__remove'></button>
                    <img class='calc-item__pic' src='/uploads/images/$construct->imageFile' alt=''></div>
                    <div class='calc-item__content'><div class='calc-item__header'><span class='calc-item__title'>$construct->title</span><span class='selective__price'>$construct->price</span>
                    <div class='calc-item-qua'><span class='calc-item-qua__btn'><span class='calc-item-qua__char'>?</span></span></div></div>
                    <div class='calc-item__controls match-height'><div class='row row_micro'>
                    <div class='col col--lg-6'><div class='selective calc-item__control'>
                    <div class='selective__cotnent selective__cotnent_left'>
                        $const111
                    </div>
                    <div class='selective__header'><span class='selective__title'>$title1</span><span class='selective__price'>0</span><i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-6'><div class='selective calc-item__control'><div class='selective__cotnent selective__cotnent_right'>
                        $const222
                    </div>
                    <div class='selective__header'><span class='selective__title'>$title2</span><span class='selective__price'>0</span><i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-12'><div class='selective calc-item__control'><div class='selective__cotnent selective__cotnent_right'>
                        $const333
                    </div>
                    <div class='selective__header'>
                    <span class='selective__title'>$title3</span><span class='selective__price'>0</span><i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-12'><div class='selective calc-item__control calc-item__control_to'><label class='checkbox'><input type='checkbox' class='checkbox__input'>
                    <span class='checkbox__ok'>Добавить логотип на упаковку</span></label></div></div></div></div></div></div></div>";
                    
                    $zakaz = "<div class='detail-order__item' det='$idc'><div class='detail-order__header'><div class='detail-order__img'><span class='detail-order__remove'></span>
                    <img src='images/small-s-item.jpg' alt=''></div><div class='detail-order__content'><span class='calc-item__title'>$construct->title</span>
                    <div class='order-toggle toggle-widget'><button class='toggle-trigger order-toggle__arrow'></button>
                    <div class='toggle-widget__content '><div class='order-toggle__content'><div class='order-toggle__item order-toggle__item_offset'>
                    <span class='order-toggle__title'>$title1</span><span class='order-toggle__desc' det='$idc1'>$const1_one</span></div>
                    <div class='order-toggle__item order-toggle__item_offset'><span class='order-toggle__title'>$title2</span>
                    <span class='order-toggle__desc' det='$idc2'>$const2_one</span></div><div class='order-toggle__item order-toggle__item_offset'>
                    <span class='order-toggle__title'>$title3</span><span class='order-toggle__desc' det='$idc3'>$const3_one</span></div></div></div></div>
                    <div class='detail-order__nav'><div class='counter counter_offset'><button class='counter__btn counter__btn_minus'></button>
                    <input type='text' class='only-numb counter__input' value='1'><button class='counter__btn counter__btn_plus'></button></div>
                    <span class='order-item__price'>$price</span> руб.</div></div></div></div>";
                }elseif(count($const) == '4'){
                    $const1 = Constructor::find()->where(['parent_id'=>$const[0]->id])->all();
                    $const2 = Constructor::find()->where(['parent_id'=>$const[1]->id])->all();
                    $const3 = Constructor::find()->where(['parent_id'=>$const[2]->id])->all();
                    $const4 = Constructor::find()->where(['parent_id'=>$const[3]->id])->all();
                    $const1_one = Constructor::find()->where(['parent_id'=>$const[0]->id])->one()->title;
                    $const2_one = Constructor::find()->where(['parent_id'=>$const[1]->id])->one()->title;
                    $const3_one = Constructor::find()->where(['parent_id'=>$const[2]->id])->one()->title;
                    $const4_one = Constructor::find()->where(['parent_id'=>$const[3]->id])->one()->title;
                    $price = $construct->price;
                    $title1 = $const[0]->title;
                    $title2 = $const[1]->title;
                    $title3 = $const[2]->title;
                    $title4 = $const[3]->title;
                    $idc = $data['id'];
                    $idc1 = $data['id'].'1';
                    $idc2 = $data['id'].'2';
                    $idc3 = $data['id'].'3';
                    $idc4 = $data['id'].'4';
                    foreach ($const1 as $c){
                        array_push($const11, 
                        "<div class='selective-item' col='$idc1'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c->title</span><span class='puck-select__price'>$c->price</span>
                            </div>
                        </div>");
                    }
                    $const111 = implode($const11);
                    foreach ($const2 as $c2){
                        array_push($const22, 
                        "<div class='selective-item' col='$idc2'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico' style='background-color:$c2->color; border:1px solid #d2d2d2'><img src='/uploads/images/$c2->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c2->title</span><span class='puck-select__price'>$c2->price</span>
                            </div>
                        </div>");
                    }
                    $const222 = implode($const22);
                    foreach ($const3 as $c3){
                        array_push($const33, 
                        "<div class='selective-item' col='$idc3'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c3->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c3->title</span><span class='puck-select__price'>$c3->price</span>
                            </div>
                        </div>");
                    }
                    $const333 = implode($const33);
                    foreach ($const4 as $c4){
                        array_push($const44, 
                        "<div class='selective-item' col='$idc4'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c4->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c4->title</span><span class='puck-select__price'>$c4->price</span>
                            </div>
                        </div>");
                    }
                    $const444 = implode($const44);
                    $model = "<div class='col col--lg-4 parent_col' col='$idc'><div class='calc-item'><div class='calc-item__img'><button class='calc-item__remove'></button>
                    <img class='calc-item__pic' src='/uploads/images/$construct->imageFile' alt=''></div>
                    <div class='calc-item__content'><div class='calc-item__header'><span class='calc-item__title'>$construct->title</span><span class='selective__price'>$construct->price</span>
                    <div class='calc-item-qua'><span class='calc-item-qua__btn'><span class='calc-item-qua__char'>?</span></span></div></div>
                    <div class='calc-item__controls match-height'><div class='row row_micro'>
                    <div class='col col--lg-6'><div class='selective calc-item__control'>
                    <div class='selective__cotnent selective__cotnent_left'>
                        $const111
                    </div>
                    <div class='selective__header'><span class='selective__title'>$title1</span><span class='selective__price'>0</span><i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-6'><div class='selective calc-item__control'><div class='selective__cotnent selective__cotnent_right'>
                        $const222
                    </div>
                    <div class='selective__header'><span class='selective__title'><i class='selective__color selective__color_green'></i>$title2</span><span class='selective__price'>0</span><i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-12'><div class='selective calc-item__control'><div class='selective__cotnent'>$const333</div>
                    <div class='selective__header'><span class='selective__title'>$title3</span><span class='selective__price'>0</span>
                    <i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-12'><div class='selective calc-item__control'><div class='selective__cotnent'>$const444</div>
                    <div class='selective__header'><span class='selective__title'>$title4</span><span class='selective__price'>0</span>
                    <i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-12'><div class='selective calc-item__control calc-item__control_to'><label class='checkbox'><input type='checkbox' class='checkbox__input'>
                    <span class='checkbox__ok'>Добавить логотип на упаковку</span></label></div></div></div></div></div></div></div>";
                    
                    $zakaz = "<div class='detail-order__item' det='$idc'><div class='detail-order__header'><div class='detail-order__img'><span class='detail-order__remove'></span>
                    <img src='images/small-s-item.jpg' alt=''></div><div class='detail-order__content'><span class='calc-item__title'>$construct->title</span>
                    <div class='order-toggle toggle-widget'><button class='toggle-trigger order-toggle__arrow'></button>
                    <div class='toggle-widget__content '><div class='order-toggle__content'><div class='order-toggle__item order-toggle__item_offset'>
                    <span class='order-toggle__title'>$title1</span><span class='order-toggle__desc' det='$idc1'>$const1_one</span></div>
                    <div class='order-toggle__item order-toggle__item_offset'><span class='order-toggle__title'>$title2</span>
                    <span class='order-toggle__desc' det='$idc2'>$const2_one</span></div><div class='order-toggle__item order-toggle__item_offset'>
                    <span class='order-toggle__title'>$title3</span><span class='order-toggle__desc' det='$idc3'>$const3_one</span></div>
                    <div class='order-toggle__item order-toggle__item_offset'><span class='order-toggle__title'>$title4</span>
                    <span class='order-toggle__desc' det='$idc4'>$const4_one</span></div></div></div></div>
                    <div class='detail-order__nav'><div class='counter counter_offset'><button class='counter__btn counter__btn_minus'></button>
                    <input type='text' class='only-numb counter__input' value='1'><button class='counter__btn counter__btn_plus'></button></div>
                    <span class='order-item__price'>$price руб.</span></div></div></div></div>";
                    
                }elseif(count($const) == '2'){
                    $const1 = Constructor::find()->where(['parent_id'=>$const[0]->id])->all();
                    $const2 = Constructor::find()->where(['parent_id'=>$const[1]->id])->all();
                    $const1_one = Constructor::find()->where(['parent_id'=>$const[0]->id])->one()->title;
                    $const2_one = Constructor::find()->where(['parent_id'=>$const[1]->id])->one()->title;
                    $price = $construct->price;
                    $title1 = $const[0]->title;
                    $title2 = $const[1]->title;
                    $idc = $data['id'];
                    $idc1 = $data['id'].'1';
                    $idc2 = $data['id'].'2';
                    foreach ($const1 as $c){
                        array_push($const11, 
                        "<div class='selective-item' col='$idc1'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c->title</span>
                            </div>
                        </div>");
                    }
                    $const111 = implode($const11);
                    foreach ($const2 as $c2){
                        array_push($const22, 
                        "<div class='selective-item' col='$idc2'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c2->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c2->title</span>
                            </div>
                        </div>");
                    }
                    $const222 = implode($const22);
                    $model = "<div class='col col--lg-4 parent_col' col='$idc'><div class='calc-item'><div class='calc-item__img'><button class='calc-item__remove'></button>
                    <img class='calc-item__pic' src='/uploads/images/$construct->imageFile' alt=''></div>
                    <div class='calc-item__content'><div class='calc-item__header'><span class='calc-item__title'>$construct->title</span>
                    <div class='calc-item-qua'><span class='calc-item-qua__btn'><span class='calc-item-qua__char'>?</span></span></div></div>
                    <div class='calc-item__controls match-height'><div class='row row_micro'>
                    <div class='col col--lg-12'><div class='selective calc-item__control'><div class='selective__cotnent'>$const111</div>
                    <div class='selective__header'><span class='selective__title'>$title1</span>
                    <i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-12'><div class='selective calc-item__control'><div class='selective__cotnent'>$const222</div>
                    <div class='selective__header'><span class='selective__title'>$title2</span>
                    <i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-12'><div class='selective calc-item__control calc-item__control_to'><label class='checkbox'><input type='checkbox' class='checkbox__input'>
                    <span class='checkbox__ok'>Добавить логотип на упаковку</span></label></div></div></div></div></div></div></div>";
                    
                    $zakaz = "<div class='detail-order__item' det='$idc'><div class='detail-order__header'><div class='detail-order__img'><span class='detail-order__remove'></span>
                    <img src='images/small-s-item.jpg' alt=''></div><div class='detail-order__content'><span class='calc-item__title'>$construct->title</span>
                    <div class='order-toggle toggle-widget'><button class='toggle-trigger order-toggle__arrow'></button>
                    <div class='toggle-widget__content '><div class='order-toggle__content'><div class='order-toggle__item order-toggle__item_offset'>
                    <span class='order-toggle__title'>$title1</span><span class='order-toggle__desc' det='$idc1'>$const1_one</span></div>
                    <div class='order-toggle__item order-toggle__item_offset'><span class='order-toggle__title'>$title2</span>
                    <span class='order-toggle__desc' det='$idc2'>$const2_one</span></div></div></div></div>
                    <div class='detail-order__nav'><div class='counter counter_offset'><button class='counter__btn counter__btn_minus'></button>
                    <input type='text' class='only-numb counter__input' value='1'><button class='counter__btn counter__btn_plus'></button></div>
                    <span class='order-item__price'>$price руб.</span></div></div></div></div>";
                    
                }else{
                    $const1 = Constructor::find()->where(['parent_id'=>$const[0]->id])->all();
                    $const1_one = Constructor::find()->where(['parent_id'=>$const[0]->id])->one()->title;
                    $price = $construct->price;
                    $title1 = $const[0]->title;
                    $idc = $data['id'];
                    $idc1 = $data['id'].'1';
                    foreach ($const1 as $c){
                        array_push($const11, 
                        "<div class='selective-item' col='$idc1'>
                            <div class='iconed iconed_center puck-select'>
                                <div class='iconed__ico puck-select__ico'><img src='/uploads/images/$c->iconFile' alt=''>
                                </div>
                                <span class='puck-select__title'>$c->title</span>
                            </div>
                        </div>");
                    }
                    $const111 = implode($const11);
                    $model = "<div class='col col--lg-4 parent_col' col='$idc'><div class='calc-item'><div class='calc-item__img'><button class='calc-item__remove'></button>
                    <img class='calc-item__pic' src='/uploads/images/$construct->imageFile' alt=''></div>
                    <div class='calc-item__content'><div class='calc-item__header'><span class='calc-item__title'>$construct->title</span>
                    <div class='calc-item-qua'><span class='calc-item-qua__btn'><span class='calc-item-qua__char'>?</span></span></div></div>
                    <div class='calc-item__controls match-height'><div class='row row_micro'>
                    <div class='col col--lg-12'><div class='selective calc-item__control'><div class='selective__cotnent'>$const111</div>
                    <div class='selective__header'><span class='selective__title'>$title1</span>
                    <i class='selective__arrow'><span class='selective-tile'></span></i></div></div></div>
                    <div class='col col--lg-12'><div class='selective calc-item__control calc-item__control_to'><label class='checkbox'><input type='checkbox' class='checkbox__input'>
                    <span class='checkbox__ok'>Добавить логотип на упаковку</span></label></div></div></div></div></div></div></div>";
                    
                    $zakaz = "<div class='detail-order__item' det='$idc'><div class='detail-order__header'><div class='detail-order__img'><span class='detail-order__remove'></span>
                    <img src='images/small-s-item.jpg' alt=''></div><div class='detail-order__content'><span class='calc-item__title'>$construct->title</span>
                    <div class='order-toggle toggle-widget'><button class='toggle-trigger order-toggle__arrow'></button>
                    <div class='toggle-widget__content '><div class='order-toggle__content'><div class='order-toggle__item order-toggle__item_offset'>
                    <span class='order-toggle__title'>$title1</span><span class='order-toggle__desc' det='$idc1'>$const1_one</span></div></div></div></div>
                    <div class='detail-order__nav'><div class='counter counter_offset'><button class='counter__btn counter__btn_minus'></button>
                    <input type='text' class='only-numb counter__input' value='1'><button class='counter__btn counter__btn_plus'></button></div>
                    <span class='order-item__price'>$price руб.</span></div></div></div></div>";
                    
                }
                
		$res = \Yii::$app->getResponse();
		$res->format = \yii\web\Response::FORMAT_JSON;
		$res->data = [$model, $zakaz];
		$res->send();
	
	}
	
	
}