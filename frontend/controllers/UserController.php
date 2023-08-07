<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\data\Pagination;
use yii\data\Sort;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $newModel = new User();
        $query = User::find();
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 5
        ]);
        $sort = new Sort([
            'attributes' => [
                'username',
                'first_name',
                'last_name',
                'phone',
                'status'
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

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
     * Updates an existing User model.
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
