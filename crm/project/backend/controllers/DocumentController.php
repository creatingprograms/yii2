<?php

namespace backend\controllers;

use Yii;
use backend\models\Document;
use backend\models\Notification;
use backend\models\DocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Project;
use backend\models\Event;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
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
						'allow' => true,
						'roles' => ['?'],
						'actions' => ['update'],
						'matchCallback' => function () {
							return true;
						}
					],
					[
						'allow' => false,
						'roles' => ['?'],
						'denyCallback' => function($rule, $action) {
							return $this->redirect(Url::toRoute(['/site/login']));
						}
					],
					[
						'actions' => ['update'],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							/** @var User $user */
							$user = Yii::$app->user->getIdentity();
							return $user->isUser() || $user->isSub();
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
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
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
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();
		
        $array = ['0' => '--Выберите объект--'];
        $projects = Project::find()->all();
        $blocks = ArrayHelper::map($projects,'id','title');
        $data = ($array+$blocks);
		
        $array2 = ['0' => '--Выберите событие--'];
        $events = Event::find()->all();
        $blocks2 = ArrayHelper::map($events,'id','title');
        $data2 = ($array2+$blocks2);
        $type = ['0' => '--Выберите тип документа--', '1' => 'Запрос на клиента', '2' => 'Описание этапа', '10' => 'Прикреплен клиентом'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('create', [
				'model' => $model,
				'projects' => $data,
				'events' => $data2,
				'type' => $type
			]);
		} else {
			return $this->render('create', [
				'model' => $model,
				'projects' => $data,
				'events' => $data2,
				'type' => $type
			]);
		}
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		// доп проверка
		if($model->type_id == '10' && Yii::$app->user->isGuest){
			return $this->redirect(['/site/login']);
		}

        $array = ['0' => '--Выберите объект--'];
        $projects = Project::find()->all();
        $blocks = ArrayHelper::map($projects,'id','title');
        $data = ($array+$blocks);
		if($model->project_id != 0){
			$project = Project::find()->where(['id' => $model->project_id])->one();
		}else{
			$event = Event::find()->where(['id' => $model->event_id])->one();
			$project = Project::find()->where(['id' => $event->project_id])->one();
		}
		
		
        $array2 = ['0' => '--Выберите событие--'];
        $events = Event::find()->all();
        $blocks2 = ArrayHelper::map($events,'id','title');
        $data2 = ($array2+$blocks2);
        $type = ['0' => '--Выберите тип документа--', '1' => 'Запрос на клиента', '2' => 'Описание этапа', '10' => 'Прикреплен клиентом'];

        if ($model->load(Yii::$app->request->post())) {
			$model->doc_file = UploadedFile::getInstances($model, 'doc_file');
			$dir = Yii::getAlias('@images').'/documents/';
			if($file = UploadedFile::getInstance($model, 'upload_doc')){
				$model->doc_file = $file->name;
				$file->saveAs($dir.$model->doc_file);
				$model->link = '/uploads/documents/'.$model->doc_file;
				$model->title = $model->doc_file;
			}
			if($model->type_id == '1' && (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->isUser()|| Yii::$app->user->getIdentity()->isSub())){
				$model->type_id = 10;
			}
			if($model->save()){
				return $this->redirect(['/event/index']);
			}
		}

		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('update', [
            'model' => $model,
			'projects' => $data,
			'events' => $data2,
			'type' => $type,
			'project' => $project
			]);
		} else {
			return $this->render('update', [
            'model' => $model,
			'projects' => $data,
			'events' => $data2,
			'type' => $type,
			'project' => $project
			]);
		}
    }

    /**
     * Deletes an existing Document model.
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
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
