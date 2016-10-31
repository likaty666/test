<?php

namespace app\controllers;

use app\models\blog;
use app\models\EntryForm;
use app\models\Feedback;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHelloWorld($message = "Hi u")
    {
        return $this->render('hello', ['msg' => $message, 'msg2' => "Winter is coming"]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $name = Html::encode($model->name);
            $email = $model->email;
            $age = $model->age;
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
            return $this->render('success', ['name' => $name, 'email' => $email]);
        }
        return $this->render('entry', ['model' => $model]);
    }

    public function actionHelloAgain($message = "Hello mean world")
    {
        return $this->render('helloAgain', ['msg2' => $message]);
    }

    public function actionFeedback()
    {
        $model = new Feedback();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $name = ($model->name);
            $email = $model->email;
            $age = $model->age;
            $inn = $model->inn;
            $about = $model->about;
            $model->file = UploadedFile::getInstance($model, 'file');
            $fpath = 'uploads/' . $model->file->baseName . '.' . $model->file->extension;
            $model->file->saveAs($fpath);
            Yii::$app->mailer->compose('temp', ['model' => $model])
                ->setFrom("noreply@yii.net")
                ->setTo($email)
                ->setSubject("Hi me")
//                ->setTextBody($about)
                ->attach($fpath)
                ->send();
            return $this->render('goodFeed', ['name' => $name, 'email' => $email]);
        }
        return $this->render('feedback', ['model' => $model]);
    }

    public function actionShowComments()
    {
        $comments = Blog::findOne(1);
        if ($comments->load(Yii::$app->request->post()) && $comments->validate()) {
            $comments->save();
        }
        return $this->render('comments', ['comments'=> $comments]);
    }

}
