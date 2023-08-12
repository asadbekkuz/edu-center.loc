<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Room;
use frontend\models\search\RoomSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
{

    /**
     * Lists all Room models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Room model.
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

    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response | array
     *
     */
    public function actionCreate()
    {
        $model = new Room();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $response['status'] = false;
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    $response['status'] = true;
                }
            }
            $response['content'] = $this->renderAjax('create', ['model' => $model]);
            return $response;
        }else{
            return $this->redirect('index');
        }
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
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
     * Deletes an existing Room model.
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
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
