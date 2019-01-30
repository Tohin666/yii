<?php

namespace app\controllers;

use app\actions\HelloAction;
use Yii;
use yii\caching\DbDependency;
use yii\filters\AccessControl;
use yii\filters\PageCache;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // кэширование целой страницы задается в поведении контроллера при помощи класса PageCache
            'cache' => [
                'class' => PageCache::class,
                // перечисляем экшены на которые будет распространятся это правило
                'only' => ['contact'],
                // дальше все как и с кэшированием фрагментов
                'duration' => 200,
//                'enabled' => Yii::$app->request->isGet,
                'enabled' => false,
//                'dependency' => [
//                    'class' => DbDependency::class,
//                    'sql' => "SELECT COUNT(*) FROM tasks",
//                ],
                'variations' => [Yii::$app->language],
            ],
            // AccessControl ограничевает доступ к экшенам на основе ролей
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        // экшен логаут доступен только для авторизованных пользователей
                        // (алиас @ - авторизованные, ? - не авторизованные)
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            // фильтры ограничивают действия контроллеров.
            'verbs' => [
                'class' => VerbFilter::className(),
                // экшен логаут сработает только при запросе пост.
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    // Экшены контроллера могут существовать не только в виде методов, но и в виде классов. Данные классы-экшены можно
    // через конфигурацию подсоединить к контроллеру, в ключах указав названия контроллеров. В классе-экшене надо
    // переопределить метод ран.
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
            'hello' => [
                'class' => HelloAction::class
            ]
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
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['user/index']);
//            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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


    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('entry', ['model' => $model]);
        }
    }


    public function actionLanguage()
    {
        $session = Yii::$app->session;
        if (\Yii::$app->language == "ru") {
            $session['language'] = "en";
        } else {
            $session['language'] = "ru";
        }
        $this->redirect(Yii::$app->request->referrer);
    }
}
