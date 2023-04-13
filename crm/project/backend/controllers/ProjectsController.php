<?php

namespace backend\controllers;

use Yii;
use backend\models\Projects;
use backend\models\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use backend\models\Status;
use backend\models\Event;
use backend\models\EventSearch;
use backend\models\Notification;
use backend\models\Document;
use backend\models\DocumentSearch;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectsController extends Controller
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
						'allow' => false,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							/** @var User $user */
							$user = Yii::$app->user->getIdentity();
							return $user->isSub();
						}
					],
					[
						'allow' => true,
						'roles' => ['@'],
						'actions' => ['index', 'view'],
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
		$params = [];
		if(Yii::$app->user->getIdentity()->isUser()){
			$params = Yii::$app->request->queryParams;
			if($params){
				if(count($params) == 1 && array_key_first($params) != "ProjectsSearch"){
					$params += ['ProjectsSearch'=>['user_id'=>Yii::$app->user->getIdentity()->id]];
				}else{
					foreach($params as $key => $par){
						if(is_array($par)){
							$params[$key]+=['user_id'=>Yii::$app->user->getIdentity()->id];
						}
					}
				}
			}else{
				$params = ['ProjectsSearch'=>['user_id'=>Yii::$app->user->getIdentity()->id]];
				//var_dump($params);die();
			}
			//$dataProvider = Project::find()->where(['user_id' => Yii::$app->user->getIdentity()->id]);
			$dataProvider = $searchModel->search($params);
		}else{
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		}
		$type = ['1' => 'Часный дом', '2' => 'Многоквартирный дом', '3' => 'Комерческое здание', '4' => 'Другое'];
		$status = Status::find()->all();
		$sts = ArrayHelper::map($status,'id','title');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'type' => $type,
			'sts' => $sts,
			'params' => $params
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$type = ['1' => 'Часный дом', '2' => 'Многоквартирный дом', '3' => 'Комерческое здание', '4' => 'Другое'];
		$status = Status::find()->all();
		$first_el = ['0' => '-Выберите статус-'];
		$sts = ArrayHelper::map($status,'id','title');
		$sts = ($first_el + $sts);
		$documents = Document::find()->where(['project_id' => $id])->all();
		
		$searchEvent = new EventSearch();
		$searchDocument = new DocumentSearch();
		if(Yii::$app->user->getIdentity()->isUser()){
			$dataEvent = Event::find()->where(['user_id' => Yii::$app->user->getIdentity()->id])->andWhere(['project_id' => $id]);
			$dataDocument = Document::find()->where(['project_id' => $id]);
		}else{
			$dataEvent = Event::find()->where(['project_id' => $id]);
			$dataDocument = Document::find()->where(['project_id' => $id]);
		}
		
		
		if(Yii::$app->user->getIdentity()->isUser()){
			$events = Event::find()->where(['user_id' => Yii::$app->user->getIdentity()->id])->andWhere(['project_id' => $id])->all();
		}elseif(Yii::$app->user->getIdentity()->isSub()){
			$events = Event::find()->where(['sub_id' => Yii::$app->user->getIdentity()->id])->andWhere(['project_id' => $id])->all();
		}else{
			$events = Event::find()->where(['project_id' => $id])->all();
		}
		$data_ev = '[';
		foreach($events as $ev){
			$data_ev .='{ "start": "' . date("Y-m-d", $ev->created_at) . '", "end": "' . date("Y-m-d", $ev->created_at) . '", "id": "' . $ev->id . '" },';
		}
		$data_ev .= ']';
		
		
		
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('view', [
				'model' => $this->findModel($id),
				'type' => $type,
				'sts' => $sts,
				'searchEvent' => $searchEvent,
				'dataEvent' => $dataEvent,
				'documents' => $documents,
				'dataDocument' => $dataDocument,
				'searchDocument' => $searchDocument,
				'data_ev' => $data_ev
			]);
		} else {
			return $this->render('view', [
				'model' => $this->findModel($id),
				'type' => $type,
				'sts' => $sts,
				'searchEvent' => $searchEvent,
				'dataEvent' => $dataEvent,
				'documents' => $documents,
				'dataDocument' => $dataDocument,
				'searchDocument' => $searchDocument,
				'data_ev' => $data_ev
			]);
		}
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();
		
        $array = ['0' => '--Выберите клиента--'];
        $array_men = ['0' => '--Выберите менеджера--'];
        $clients = User::find()->where(['role' => 1])->all();
        $managers = User::find()->where(['role' => 5])->all();
        $cl = ArrayHelper::map($clients,'id','username');
        $men = ArrayHelper::map($managers,'id','username');
        $data = ($array+$cl);
        $data_men = ($array_men+$men);
		
		$type = ['' => 'Выберите тип договора', '1' => 'Часный дом', '2' => 'Многоквартирный дом', '3' => 'Комерческое здание'];
		$status = Status::find()->all();
		$first_el = ['' => '-Выберите статус-'];
		$sts = ArrayHelper::map($status,'id','title');
		$sts = ($first_el + $sts);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			$event = new Event();
			$event->title = 'Создание нового договора';
			$event->project_id = $model->id;
			$event->status = $model->status_id;
			$event->save();
			
			
			$men_n=User::find()->where(['id' => $model->manager_id])->one();
			$user_n=User::find()->where(['id' => $model->user_id])->one();
			$not = new Notification();
			$not->title = 'Создание нового договора';
			$not->description = 'Менеджер: <b>' . $men_n->username. '</b> создал новый договор, <b>"'.$model->title . '"</b>, с клиентом: <b>' . $user_n->username . '</b>';
			$not->user_id = $user_n->id;
			$not->manager_id = $men_n->id;
			$not->status = "1";
			$not->status_ad = "1";
			$not->save();
			
            return $this->redirect(['index']);
        }
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('create', [
				'model' => $model,
				'users' => $data,
				'men' => $data_men,
				'type' => $type,
				'sts' => $sts
			]);
		} else {
			return $this->render('create', [
				'model' => $model,
				'users' => $data,
				'men' => $data_men,
				'type' => $type,
				'sts' => $sts
			]);
		}
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        
        $array = ['0' => '--Выберите клиента--'];
        $array_men = ['0' => '--Выберите менеджера--'];
        $users = User::find()->where(['role' => 1])->all();
        $mens = User::find()->where(['role' => 5])->all();
        $blocks = ArrayHelper::map($users,'id','username');
        $blocks_men = ArrayHelper::map($mens,'id','username');
        $data = ($array+$blocks);
        $data_men = ($array_men+$blocks_men);
		
		
		$type = ['0' => 'Выберите тип договора', '1' => 'Часный дом', '2' => 'Многоквартирный дом', '3' => 'Комерческое здание'];
		$status = Status::find()->all();
		$first_el = ['0' => '-Выберите статус-'];
		$sts = ArrayHelper::map($status,'id','title');
		$sts = ($first_el + $sts);
		$id_old = $model->manager_id;
        if ($model->load(Yii::$app->request->post())) {
			$project = Yii::$app->request->post();
			if ($model->save()) {
				if($project ["Project"]["manager_id"] != $id_old){
					$evs = Event::find()->where(['project_id' => $model->id])->all();
					foreach($evs as $ev){
						$ev->manager_id = $model->manager_id;
						$ev->save();
					}
				}
				return $this->redirect(['index']);
			}
        }
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('update', [
				'model' => $model,
				'users' => $data,
				'men' => $data_men,
				'type' => $type,
				'sts' => $sts
			]);
		} else {
			return $this->render('update', [
				'model' => $model,
				'users' => $data,
				'men' => $data_men,
				'type' => $type,
				'sts' => $sts
			]);
		}
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		$event = Event::find()->where(['project_id' => $id])->all();
		foreach($event as $p){
			Event::findOne($p->id)->delete();
		}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
