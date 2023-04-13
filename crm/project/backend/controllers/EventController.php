<?php

namespace backend\controllers;

use Yii;
use backend\models\Event;
use backend\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use backend\models\Document;
use backend\models\Project;
use backend\models\Notification;
use backend\models\User;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
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
						'actions' => ['index', 'list', 'viewpc', 'view', 'listev'],
						'matchCallback' => function ($rule, $action) {
							/** @var User $user */
							$user = Yii::$app->user->getIdentity();
							return $user->isUser() || $user->isSub();
						}
					],
					[
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
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
		if(Yii::$app->user->getIdentity()->isUser()){
			$dataProvider = Event::find()->where(['user_id' => Yii::$app->user->getIdentity()->id]);
		}elseif(Yii::$app->user->getIdentity()->isSub()){
			$dataProvider = Event::find()->where(['sub_id' => Yii::$app->user->getIdentity()->id]);
		}else{
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		}
		$not = '';
		
		$request = Yii::$app->request;
		$notification = $request->get('notification'); 
		if(!empty($notification)){
			$id = Notification::find()->where(['id' => $notification])->one()->event_id;
			$not = Event::find()->where(['id' => $id])->one()->id;
		}
		
		
		if(Yii::$app->user->getIdentity()->isUser()){
			$model = Project::find()->where(['user_id' => Yii::$app->user->getIdentity()->id])->one();
			$events = Event::find()->where(['user_id' => Yii::$app->user->getIdentity()->id])->all();
			$projects = Project::find()->where(['user_id' => Yii::$app->user->getIdentity()->id])->all();
		}elseif(Yii::$app->user->getIdentity()->isSub()){
			$model = Project::find()->one();
			$events = Event::find()->where(['sub_id' => Yii::$app->user->getIdentity()->id])->all();
			$projects = Project::find()->all();
		}else{
			$model = Project::find()->one();
			$events = Event::find()->all();
			$projects = Project::find()->all();
		}
        //$array = ['0' => '--Выберите объект--'];
        $pr = ArrayHelper::map($projects,'id','title');
        //$pr = ($array+$blocks);
		$data = '[';
		foreach($events as $ev){
			$data .='{ "start": "' . date("Y-m-d", $ev->created_at) . '", "end": "' . date("Y-m-d", $ev->created_at) . '", "id": "' . $ev->id . '" },';
		}
		$data .= ']';

		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'data' => $data,
				'projects' => $pr,
				'model' => $model,
				'not' => $not
			]);
		} else {
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'data' => $data,
				'projects' => $pr,
				'model' => $model,
				'not' => $not
			]);
		}
    }
    public function actionEvobject()
    {
		$request = Yii::$app->request;
		$object = $request->post('object');
		if($object != null){
			$model = Project::find()->where(['id' => $object])->one();
			$events = Event::find()->where(['project_id' => $object])->all();
			$data = '[';
			foreach($events as $ev){
				$data .='{ "start": "' . date("Y-m-d", $ev->created_at) . '", "end": "' . date("Y-m-d", $ev->created_at) . '", "id": "' . $ev->id . '" },';
			}
			$data .= ']';
			
			$data2 = [];
			
			foreach ($events as $event) {
				array_push($data2, ['start' => date("Y-m-d", $event->created_at), 'end' => date("Y-m-d", $event->created_at), 'id' => $event->id]);
			}
			
		}else{
		
			$model = Project::find()->one();
			$events = Event::find()->all();
			$data = '[';
			foreach($events as $ev){
				$data .='{ "start": "' . date("Y-m-d", $ev->created_at) . '", "end": "' . date("Y-m-d", $ev->created_at) . '", "id": "' . $ev->id . '" },';
			}
			$data .= ']';
		}

		if (Yii::$app->request->isAjax) {
			return $this->asJson($data2);
		} else {
			return $this->render('evobject', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'data' => $data,
				'projects' => $pr,
				'model' => $model
			]);
		}
    }

    public function actionList()
    {
        $searchModel = new EventSearch();
		if(Yii::$app->user->getIdentity()->isUser()){
			$dataProvider = Event::find()->where(['user_id' => Yii::$app->user->getIdentity()->id]);
		}elseif(Yii::$app->user->getIdentity()->isSub()){
			$dataProvider = Event::find()->where(['sub_id' => Yii::$app->user->getIdentity()->id]);
		}else{
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		}
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Event model.
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
	public function actionViewpc()
    {
		$request = Yii::$app->request;
        $model = $this->findModel($request->post('date'));
        $not = Notification::find()->where(['event_id' => $request->post('date')])->andWhere(['status_us' => '1'])->one();
		if(empty($not)){
			$not = '';
		}
		$document = Document::find()->where(['event_id' => $model->id])->andWhere(['type_id' => 1])->one();
		if(empty($document)){
			$document = '';
		}
		$project = Project::find()->where(['id' => $model->project_id])->one();
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('viewpc', [
				'model' => $model,
				'document' => $document,
				'not' => $not,
				'project' => $project
			]);
		} else {
			return $this->render('viewpc', [
				'model' => $model,
				'not' => $not,
				'project' => $project
			]);
		}
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();
		
		$request = Yii::$app->request;
		$model->created_at = $request->post('date');
        $array = $array2 = $array3 = ['0' => 'Выберите и начните вводить'];
        $projects = Project::find()->all();
        $clients = User::find()->where(['role' => '1'])->all();
		$sub = User::find()->where(['role' => '2'])->all();
        $blocks = ArrayHelper::map($projects,'id','title');
        $blocks2 = ArrayHelper::map($clients,'id','username');
        $blocks3 = ArrayHelper::map($sub,'id','username');
        $data['projects'] = ($array+$blocks);
        $data['clients'] = ($array2+$blocks2);
        $data['sub'] = ($array3+$blocks3);
        $statusArray = [
            '1' => 'Согласованно',
            '2' => 'Не согласованно',
            '3' => 'Ожидание'
        ];
        $typeArray = [
            '1' => 'блокирующий',
            '2' => 'не блокирующий'
        ];
        $data['type'] = $typeArray;
        $data['status'] = $statusArray;
		
        if ($model->load(Yii::$app->request->post())) {
			
            if (Yii::$app->request->isPost) {
                $model->doc_file = UploadedFile::getInstances($model, 'doc_file');
                $dir = Yii::getAlias('@images').'/documents/';
                if($file = UploadedFile::getInstance($model, 'upload_doc')){
                    $model->doc_file = $file->name;
                    $file->saveAs($dir.$model->doc_file);
					
					$doc = new Document();
					$doc->link = $dir.$model->doc_file;
					$doc->title = $model->doc_file;
					$doc->project_id = $model->project_id;
					$doc->save();
					$model->document_id = $doc->id;
                }
				$men_n=User::find()->where(['id' => Yii::$app->user->getIdentity()->id])->one();
				$user_n=User::find()->where(['id' => $model->user_id])->one();
                if ($model->save()) {
					if ($model->unic_file == "1") {
						$doc = new Document();
						$doc->title = 'Загрузите файл';
						$doc->project_id = $model->project_id;
						$doc->event_id = $model->id;
						$doc->type_id = '1';
						if ($doc->save()) {
							$not = new Notification();
							$not->title = 'Требуется загрузка документа';
							$not->description = '<p>Менеджер: <b>' . $men_n->username. '</b> запросил у вас загрузку документа к событию: <b>"'.$model->title . '"</b>, загрузите по ссылке: </p>';
							$not->user_id = $user_n->id;
							$not->manager_id = $men_n->id;
							$not->event_id = $model->id;
							$not->document_id = $doc->id;
							$not->status = "5";
							$not->status_ad = "0";
							$not->status_men = "0";
							if($model->sub_id){
								$not->status_sub = "1";
								$not->sub_id = $model->sub_id;
							}else{
								$not->status_us = "1";
							}
							$not->save();
						}
					}
					
					$not = new Notification();
					$not->title = 'Новое событие';
					$not->description = 'Менеджер: <b>' . $men_n->username. '</b> создал новое событие, <b>"'.$model->title . '"</b>, с клиентом: <b>' . $user_n->username . '</b>';
					$not->user_id = $user_n->id;
					$not->manager_id = $men_n->id;
					$not->event_id = $model->id;
					$not->status = "1";
					$not->status_ad = "1";
					$not->status_men = "1";
					$not->status_us = "1";
					$not->save();
					
					
					
                    return $this->redirect('index');
                }
			}
		}

		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('create', [
				'model' => $model,
				'dataSpr' => $data
			]);
		} else {
			return $this->render('create', [
				'model' => $model,
				'dataSpr' => $data
			]);
		}
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


		$request = Yii::$app->request;
		$model->created_at = $request->post('date');
        $array = $array2 = $array3 = ['0' => 'Выберите и начните вводить'];
        $projects = Project::find()->all();
		$sub = User::find()->where(['role' => '2'])->all();
        $clients = User::find()->where(['role' => '1'])->all();
        $blocks = ArrayHelper::map($projects,'id','title');
        $blocks2 = ArrayHelper::map($clients,'id','username');
        $blocks3 = ArrayHelper::map($sub,'id','username');
        $data['sub'] = ($array3+$blocks3);
        $data['clients'] = ($array2+$blocks2);
        $data['projects'] = ($array+$blocks);
        $typeArray = [
            '1' => 'блокирующий',
            '2' => 'не блокирующий'
        ];
        $statusArray = [
            '1' => 'Согласованно',
            '2' => 'Не согласованно',
            '3' => 'Ожидание'
        ];
        $data['status'] = $statusArray;
        $data['type'] = $typeArray;

        if ($model->load(Yii::$app->request->post())) {
			
            if (Yii::$app->request->isPost) {
                $model->doc_file = UploadedFile::getInstances($model, 'doc_file');
                $dir = Yii::getAlias('@images').'/documents/';
                if($file = UploadedFile::getInstance($model, 'upload_doc')){
                    $model->doc_file = $file->name;
                    $file->saveAs($dir.$model->doc_file);
					
					$doc = new Document();
					$doc->link = $dir.$model->doc_file;
					$doc->title = $model->doc_file;
					$doc->project_id = $model->project_id;
					$doc->event_id = $model->id;
					$doc->save();
					$model->document_id = $doc->id;
                }
                if ($model->save()) {
                    return $this->redirect('index');
                }
			}
		}
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id, 'projects' => $data]);
        }

		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('update', [
				'model' => $model,
				'dataSpr' => $data
			]);
		} else {
			return $this->render('update', [
				'model' => $model,
				'dataSpr' => $data
			]);
		}
    }
	
    public function actionAddproject()
	{
		$request = Yii::$app->request;
		$user = $request->post('user');
		$project = Project::find()->where(['user_id' => $user])->one();
		$projects = Project::find()->where(['user_id' => $user])->all();
		
        $pr = $project->id;
		$object = [];
		$projects2 = ['<li rel="0">Выберите и начните вводить</li>'];
		foreach($projects as $p){
			array_push($projects2, '<li rel="'.$p->id.'">'.$p->title.'</li>');
		}
		$projects3 = ['<option value="0">Выберите и начните вводить</option>'];
		foreach($projects as $p){
			array_push($projects3, '<option value="'.$p->id.'">'.$p->title.'</option>');
		}
		$result = implode('', $projects2);
		
		array_push($object, ['name' => $project->title, 'project' => $pr, 'list' => $result, 'options' => $projects3, 'count' => count($projects)]);
		
		
		//$data = '';
		//foreach($projects as $ev){
		//	$data .='<lirel="'.$ev->id.'">' . date("Y-m-d", $ev->created_at) . '", "end": "' . date("Y-m-d", $ev->created_at) . '", "id": "' . $ev->id . '" },';
		//}
		//$data .= ']';
		
		
		return $this->asJson($object);
		//var_dump($pr);die();
	}
	
	public function actionListev()
    {
		$request = Yii::$app->request;
        $date = $request->post('date');
		
		if(Yii::$app->user->getIdentity()->isUser()){
			$events = Event::find()->where(['created_at' => strtotime($date)])->andWhere(['user_id' => Yii::$app->user->id])->all();
		}else{
			$events = Event::find()->where(['created_at' => strtotime($date)])->all();
		}
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('listev', [
				'events' => $events,
				'date' => $date
			]);
		} else {
			return $this->render('listev', [
				'events' => $events,
				'date' => $date
			]);
		}
    }
    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		//var_dump($id);die();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
