<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Employee;
use frontend\models\EmployeeSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['indexRoom'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['viewRoom'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['deleteRoom']
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['updateRoom']
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['createRoom']
                    ],
                    [
                        'actions' => ['message'],
                        'allow' => true,
                        'roles' => ['indexRoom']
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Employee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response['status'] = false;
        $response['content'] = $this->renderAjax('view', ['model' => $this->findModel($id)]);
        return $response;
    }

    public function actionCreate()
    {
        $model = new Employee();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $response['status'] = false;
            $data = $this->request->post('Employee');
            if ($this->request->isPost && isset($data)) {

                // transaction begin
                $transaction = Yii::$app->db->beginTransaction();

                $user = new User();
                $user->username = $data['username'];
                $user->email = $data['email'];
                $user->status = 10;
                $user->setPassword($data['password']);
                $user->generateAuthKey();

                // get teacher role
                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('teacher');

                if($user->save(false)){
                    // user saved and assign teacher role
                    $auth->assign($authorRole, $user->id);

                    $model->user_id = $user->id;
                    $model->science_id = $data['science_id'];
                    $model->first_name = $data['first_name'];
                    $model->last_name = $data['last_name'];
                    $model->address = $data['address'];
                    $model->phone = $data['phone'];
                    $model->salary = $data['salary'];
                    $model->status = $data['status'];
                    if($model->save(false)){
                        // if true, transaction successfully completed
                        $transaction->commit();
                        $response['status'] = true;
                    }else{
                        // if false, all transaction roll back
                        $transaction->rollBack();
                    }
                }
            }
            $response['content'] = $this->renderAjax('create', ['model' => $model]);
            return $response;
        }else{
            return 'Invalid response';
        }
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return array|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $response['status'] = false;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $response['status'] = true;
        }
        $response['content'] =  $this->renderAjax('update', ['model' => $model]);
        return $response;
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionMessage()
    {
        return $this->render('message');
    }

}
