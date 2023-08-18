<?php

namespace frontend\controllers;

use frontend\models\Group;
use Yii;
use yii\data\Pagination;
use yii\data\Sort;
use yii\filters\AccessControl;

class GroupController extends \yii\web\Controller
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
                        'roles' => ['indexGroup'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['viewGroup'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['deleteGroup']
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['updateGroup']
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['createGroup']
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $newModel = new Group();
        $query = Group::find();
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 5
        ]);
        $sort = new Sort([
            'attributes' => [
                'student_id',
                'course_id',
                'status',
                'created_at',
                'updated_at',
                'created_by',
                'updated_by'
            ]
        ]);

        $model = $query->orderBy($sort->orders)->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', [
            'model' => $model,
            'sort' => $sort,
            'pagination' => $pagination,
            'newModel' => $newModel
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Group();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view','id'=>$model->id]);
            }else{
                Yii::$app->session->setFlash('danger',$model->getErrorSummary(false));
            }
        }

        return $this->redirect('index');
    }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Displays a single Group model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

}
