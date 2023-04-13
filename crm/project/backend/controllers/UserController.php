<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\ProjectSearch;
use yii\filters\AccessControl;
use backend\models\Status;
use backend\models\Event;
use backend\models\EventSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
						'actions' => ['lk'],
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
                    'delete' => ['GET'],
                ],
            ],
		];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
		$model->scenario = 'create';
		
		$projects = Project::find()->where(['!=', 'status_id', '9'])->AndWhere(['user_id' => ''])->all();
		$first_el = ['' => '-Выберите свободный объект-'];
		$projects = ArrayHelper::map($projects,'id','title');
		$projects = ($first_el + $projects);
		$get_r = Yii::$app->request->get('role');
		$role = ['1' => 'Клиент', '5' => 'Менеджер', '2' => 'Субподрядчик'];
		if($get_r > 0){
			$a1 = [$get_r => $role[$get_r]];
			unset($role[$get_r]);
			$role = $a1+$role;
		}
		$type = ['1' => 'Физ. лицо', '2' => 'Юр. лицо'];

        if ($model->load(Yii::$app->request->post())) {
			
			//Перебор выбранных объектов и добавление на них данного клиента и менеджера
			$model->username = $model->name.' '.$model->surname;
			$model->setPassword($model->password);
			$model->generateAuthKey();
			
			if ($model->save()){
				if(!empty($model->projects)){
					$pr = Project::find()->where(['id'=>$model->projects])->one();
					$pr->user_id = $model->id;
					$pr->save();
				}
				return $this->redirect(['index']);
			}
        }
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('create', [
				'model' => $model,
				'projects' => $projects,
				'role' => $role,
				'type' => $type,
				'get_r' => $get_r
			]);
		} else {
			return $this->render('create', [
				'model' => $model,
				'projects' => $projects,
				'role' => $role,
				'type' => $type,
				'get_r' => $get_r
			]);
		}
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$get_r = 0;
		$projects = Project::find()->where(['!=', 'status_id', '9'])->AndWhere(['user_id' => ''])->all();
		$first_el = ['0' => '-Выберите свободный объект-'];
		$projects = ArrayHelper::map($projects,'id','title');
		$projects = ($first_el + $projects);
		$type = ['1' => 'Физ. лицо', '2' => 'Юр. лицо'];
		$projects_for = Project::find()->where(['user_id' => $model->id])->AndWhere(['!=', 'status_id', '9'])->all();
		//$projects_for = ArrayHelper::map($projects_for,'id','title');
		$project_men = Project::find()->where(['manager_id' => $model->id])->AndWhere(['!=', 'status_id', '9'])->all();
		//$project_men = ArrayHelper::map($project_men,'id','title');
        if ($model->load(Yii::$app->request->post())) {
			$model->username = $model->name . ' ' . $model->surname;
			if(!empty($model->password)){
				$model->setPassword($model->password);
				$model->generateAuthKey();
			}
			if(!empty($model->projects)){
				$pr = Project::find()->where(['id'=>$model->projects])->one();
				$pr->user_id = $model->id;
				$pr->save();
			}
			if ($model->save()){
				return $this->redirect(['index']);
			}
        }
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('update', [
				'model' => $model,
				'projects' => $projects,
				'projects_for' => $projects_for,
				'project_men' => $project_men,
				'type' => $type,
				'get_r' => $get_r
			]);
		} else {
			return $this->render('update', [
				'model' => $model,
				'projects' => $projects,
				'projects_for' => $projects_for,
				'project_men' => $project_men,
				'type' => $type,
				'get_r' => $get_r
			]);
		}
    }

    public function actionNameupdate($id)
    {
		$get_r = 0;
        $model = $this->findModel($id);
		$model->username = $model->name . ' ' . $model->surname;
		$projects = Project::find()->where(['!=', 'status_id', '9'])->AndWhere(['user_id' => ''])->all();
		$first_el = ['0' => '-Выберите свободный объект-'];
		$type = ['1' => 'Физ. лицо', '2' => 'Юр. лицо'];
		$projects = ArrayHelper::map($projects,'id','title');
		$projects = ($first_el + $projects);
		$projects_for = Project::find()->where(['user_id' => $model->id])->AndWhere(['!=', 'status_id', '9'])->all();
		//$projects_for = ArrayHelper::map($projects_for,'id','title');
		$project_men = Project::find()->where(['manager_id' => $model->id])->AndWhere(['!=', 'status_id', '9'])->all();
		//$project_men = ArrayHelper::map($project_men,'id','title');
        if ($model->load(Yii::$app->request->post())) {
			if(!empty($model->password)){
				$model->setPassword($model->password);
				$model->generateAuthKey();
			}
			if(!empty($model->projects)){
				$pr = Project::find()->where(['id'=>$model->projects])->one();
				$pr->user_id = $model->id;
				$pr->save();
			}
			if ($model->save()){
				return $this->redirect(['index']);
			}
        }
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('update', [
				'model' => $model,
				'projects' => $projects,
				'projects_for' => $projects_for,
				'project_men' => $project_men,
				'type' => $type,
				'get_r' => $get_r
			]);
		} else {
			return $this->render('update', [
				'model' => $model,
				'projects' => $projects,
				'projects_for' => $projects_for,
				'project_men' => $project_men,
				'type' => $type,
				'get_r' => $get_r
			]);
		}
    }
    public function actionLk()
    {
        $model = $this->findModel(Yii::$app->user->getIdentity()->id);
		$get_r = 0;
		$projects = Project::find()->where(['!=', 'status_id', '9'])->AndWhere(['user_id' => ''])->all();
		$first_el = ['0' => '-Выберите свободный объект-'];
		$projects = ArrayHelper::map($projects,'id','title');
		$projects = ($first_el + $projects);
		$projects_for = Project::find()->where(['user_id' => $model->id])->AndWhere(['!=', 'status_id', '9'])->all();
		//$projects_for = ArrayHelper::map($projects_for,'id','title');
		$project_men = Project::find()->where(['manager_id' => $model->id])->AndWhere(['!=', 'status_id', '9'])->all();
		//$project_men = ArrayHelper::map($project_men,'id','title');
		if(Yii::$app->user->getIdentity()->isUser()){
			$my_project = Project::find()->where(['user_id' => $model->id])->all();
		}elseif(Yii::$app->user->getIdentity()->isManager()){
			$my_project = Project::find()->where(['manager_id' => $model->id])->all();
		}else{
			$my_project = [];
		}
		
        if ($model->load(Yii::$app->request->post())) {
			$model->username = $model->name . ' ' . $model->surname;
			if(!empty($model->password)){
				$model->setPassword($model->password);
				$model->generateAuthKey();
			}
			if(!empty($model->projects)){
				$pr = Project::find()->where(['id'=>$model->projects])->one();
				$pr->user_id = $model->id;
				$pr->save();
			}
			if ($model->save()){
				return $this->redirect(['lk']);
			}
        }
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('lk', [
				'model' => $model,
				'projects' => $projects,
				'projects_for' => $projects_for,
				'project_men' => $project_men,
				'my_project' => $my_project,
				'get_r' => $get_r
			]);
		} else {
			$searchProject = new ProjectSearch();
			if(Yii::$app->user->getIdentity()->isUser()){
				$dataProject = Project::find()->where(['user_id' => Yii::$app->user->getIdentity()->id]);
			}else{
				$dataProject = $searchProject->search(Yii::$app->request->queryParams);
			}
			$type = ['1' => 'Часный дом', '2' => 'Многоквартирный дом', '3' => 'Комерческое здание', '4' => 'Другое'];
			$status = Status::find()->all();
			$first_el = ['0' => '-Выберите статус-'];
			$sts = ArrayHelper::map($status,'id','title');
			$sts = ($first_el + $sts);
			$searchEvent = new EventSearch();
			if(Yii::$app->user->getIdentity()->isUser()){
				$dataEvent = Event::find()->where(['user_id' => Yii::$app->user->getIdentity()->id]);
			}else{
				$dataEvent = $searchEvent->search(Yii::$app->request->queryParams);
			}
			return $this->render('lk', [
				'model' => $model,
				'projects' => $projects,
				'projects_for' => $projects_for,
				'project_men' => $project_men,
				'my_project' => $my_project,
				'searchProject' => $searchProject,
				'dataProject' => $dataProject,
				'type' => $type,
				'sts' => $sts,
				'searchEvent' => $searchEvent,
				'dataEvent' => $dataEvent,
				'get_r' => $get_r
			]);
		}
    }
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		if(User::find()->where(['id' => $id])->one()->role == 1){
			$project = Project::find()->where(['user_id' => $id])->all();
			foreach($project as $p){
				$mod = Project::findOne($p->id);
				$mod->user_id = '0';
				$mod->save();
			}
		}else{
			$project = Project::find()->where(['manager_id' => $id])->all();
			foreach($project as $p){
				$mod = Project::findOne($p->id);
				$mod->manager_id = '0';
				$mod->save();
			}
		}
        $this->findModel($id)->delete();

		if (Yii::$app->request->isAjax) {
			return "Пользователь удален!";
		}
			return "Пользователь удален!";
        //return $this->redirect(['index']);
    }

    public function actionActive()
    {
		$us = User::find()->where(['id' => $_POST['id']])->one();
		if($_POST["date"] == 'true'){
			$us->active = '1';
		}else{
			$us->active = '0';
		}
		$us->save();
    }
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	
    public function actionToggle($id, $attribute)
    {   
        if (!in_array($attribute, array('1', '2')))
            throw new CHttpException(400, 'Некорректный запрос');
        $model = $this->findModel($id);
        $model->active = $attribute;
        $model->save();
    }
	
	
}
