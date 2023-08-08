<?php

namespace frontend\controllers;

use frontend\models\Course;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\Sort;

class CourseController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $newModel = new Course();
        $query = Course::find();
        $dp = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'totalCount' => $query->count(),
                'defaultPageSize' => 5
            ],
            'sort' => [
                'attributes' => [
                'name',
                'science_id',
                'teacher_id',
                'price',
                'capacity',
                'status',
                'created_by',
                'updated_by'
            ]
            ]
        ]);
//        $pagination = new Pagination([
//            'totalCount' => $query->count(),
//            'defaultPageSize' => 5
//        ]);
//        $sort = new Sort([
//            'attributes' => [
//                'name',
//                'science_id',
//                'teacher_id',
//                'price',
//                'capacity',
//                'status',
//                'created_by',
//                'updated_by'
//            ]
//        ]);
//
//        $model = $query->orderBy($sort->orders)->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', [
//            'model' => $model,
//            'sort' => $sort,
//            'pagination' => $pagination,
            'newModel' => $newModel,
            'dp' => $dp
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Course();

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
     * Updates an existing Course model.
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
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Displays a single Course model.
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
