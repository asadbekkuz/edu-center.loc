<?php

namespace frontend\controllers;

use frontend\models\Course;
use frontend\models\Group;
use frontend\models\Payment;
use frontend\models\Student;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','lang','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $lidStudent = Student::find()->lid()->count();
        $activeStudent = Student::find()->active()->count();
        $groups = Group::find()->active()->count();
        $paymentDebtors = Payment::find()->debtor()->count();
        $dateTime = Course::getDateTime();

        return $this->render('index',[
            'lidStudent' => $lidStudent,
            'activeStudent' => $activeStudent,
            'groups' =>$groups,
            'paymentDebtor' => $paymentDebtors,
            'dateTime'=>json_encode($dateTime)
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {   
        $this->layout = 'main-login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLang($lang)
    {
        if (Yii::$app->request->isGet) {
            $lang = Yii::$app->request->get('lang');
            if (array_key_exists($lang, Yii::$app->params['language'])) {
                Yii::$app->session->set('language', $lang);
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->redirect('site/index');
    }
}
