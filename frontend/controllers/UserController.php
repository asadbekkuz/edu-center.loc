<?php

namespace frontend\controllers;

use frontend\models\message\UserForm;
use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class UserController extends \yii\web\Controller
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
                        'roles' => ['indexUser'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['viewUser'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['deleteUser']
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['updateUser']
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['createUser']
                    ],
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['createUser']
                    ],
                    [
                        'actions' => ['message'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'actions' => ['information'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'actions' => ['image'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return \yii\web\Response | array
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new User();
            $response['status'] = false;
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    $response['status'] = true;
                }
            }
            $response['content'] = $this->renderAjax('create', ['model' => $model]);
            return $response;
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return array
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
        $response['content'] = $this->renderAjax('update', ['model' => $model]);
        return $response;
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Displays a single User model.
     * @param int $id
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

    public function actionMessage()
    {
        $user = new UserForm();
        return $this->render('message', compact('user'));
    }

    public function actionProfile()
    {
        $user = User::findOne(['id' => Yii::$app->user->identity->id]);
        return $this->render('profile', [
            'user' => $user
        ]);
    }

    /** User Information */
    public function actionInformation()
    {
        $data = Yii::$app->request->post();
        $model = $this->findModel($data['User']['id']);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('information', 'User\'s Information successfully updated');
        } else {
            Yii::$app->session->setFlash('information', 'User\'s Information was not saved');
        }
        return $this->redirect('profile');
    }
}
