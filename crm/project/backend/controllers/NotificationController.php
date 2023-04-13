<?php

namespace backend\controllers;

use Yii;
use backend\models\Notification;
use backend\models\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Event;
use yii\filters\AccessControl;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => false,
						'roles' => ['?'],
						'denyCallback' => function($rule, $action) {
							return $this->redirect(Url::toRoute(['/site/login']));
						}
					],
					[
						'allow' => true,
						'roles' => ['@'],
						'actions' => ['matching', 'update', 'remove'],
						'matchCallback' => function ($rule, $action) {
							/** @var User $user */
							$user = Yii::$app->user->getIdentity();
							return $user->isUser();
						}
					],
					[
						'actions' => [],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							/** @var User $user */
							$user = Yii::$app->user->getIdentity();
							return $user->isAdmin() || $user->isManager();
						}
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notification model.
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
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

		if($model->status_us == 0 && Yii::$app->user->getIdentity()->isUser()){
			$this->redirect(Yii::$app->getHomeUrl());
		}else{
			return $this->render('update', [
				'model' => $model,
			]);
		}
    }

    /**
     * Deletes an existing Notification model.
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
	
	public function actionRemove()
	{
		$request = Yii::$app->request;
		$id = $request->post('id');
		//var_dump($id);die();
		$not = $this->findModel($id);
		if(Yii::$app->user->getIdentity()->isUser()){
			$not->status_us = '2';
		}elseif(Yii::$app->user->getIdentity()->isManager()){
			$not->status_men = '2';
		}elseif(Yii::$app->user->getIdentity()->isAdmin()){
			$not->status_ad = '2';
		}else{
			$not->status_sub = '2';
		}
		$not->save();
	}

    public function actionMatching($id, $act, $comment = '')
    {
		$model = Notification::find()->where(['id' => $id])->one();
		//var_dump($model);die();
		$model->status_us = 0;
		if($model->save()){
			$event = Event::find()->where(['id' => $model->event_id])->one();
			if($act == 1){
				$not = new Notification();
				$not->status_us = 0;
				$not->user_id = Yii::$app->user->id;
				$not->title = 'Отклик от клиента ' . Yii::$app->user->getIdentity()->username;
				$not->description = 'Клиент: <b>' . Yii::$app->user->getIdentity()->username. '</b> одобрил блокирующее событие, <b>"'.$model->title .'</b>, работа над объектом продолжается!';
				$not->manager_id = $model->manager_id;
				$not->event_id = $model->event_id;
				$not->status = "1";
				$not->status_ad = "1";
				$not->status_men = "1";
				$not->save();
				$event->type = 2;
				$event->status = 2;
				$event->save();
				echo "<h2>Вы успешно подтвердили данное уведомление,</br> работа по объекту продолжается!</h2>";
			}else{
				$not = new Notification();
				$not->status_us = 0;
				$not->user_id = Yii::$app->user->id;
				$not->title = 'Отклик от клиента ' . Yii::$app->user->getIdentity()->username;
				$not->description = 'Клиент: <b>' . Yii::$app->user->getIdentity()->username. '</b> хочет обсудить событие, <b>"'.$model->title .'</b>, работа над объектом приостановлена!';
				$not->manager_id = $model->manager_id;
				$not->event_id = $model->event_id;
				$not->status = "1";
				$not->status_ad = "1";
				$not->status_men = "1";
				$not->save();	
                
                $event->comment = $comment;
                $event->save();

				echo "<h2>Вы успешно согласовали уведомление,</br> в ближайшее время с вами свяжется ваш менеджер!</h2>";
			}
			
		}

    }
    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
