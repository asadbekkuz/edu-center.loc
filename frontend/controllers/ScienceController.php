<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Science;
use frontend\models\search\ScienceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ScienceController implements the CRUD actions for Science model.
 */
class ScienceController extends Controller
{
    /**
     * Lists all Science models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ScienceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Science model.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response['status'] = false;
        $response['content'] = $this->renderAjax('view', ['model' => $this->findModel($id)]);
        return $response;
    }

    /**
     * Creates a new Science model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response | array
     */
    public function actionCreate()
    {
        $model = new Science();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
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
     * Updates an existing Science model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return array|Response
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
     * Deletes an existing Science model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Science model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Science the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Science::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
