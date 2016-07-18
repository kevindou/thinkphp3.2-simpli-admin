<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\AdminForm;
use backend\models\Menu;
use yii\filters\VerbFilter;
use yii\web\UnauthorizedHttpException;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    public  $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow'   => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow'   => true,
                        'roles'   => ['@'],
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
            'error' => ['class' => 'yii\web\ErrorAction',],
        ];
    }

    // 首页显示
    public function actionIndex()
    {
        // 查询导航栏信息
        $menus = Yii::$app->cache->get('navigation'.Yii::$app->user->id);
        if ( ! $menus) throw new UnauthorizedHttpException('对不起，您还没获得显示导航栏目权限!');
        Yii::$app->view->params['menus'] = $menus;
        return $this->render('index');
    }

    // 用户登录
    public function actionLogin()
    {
        $this->layout = 'login.php';
        if (!\Yii::$app->user->isGuest) {return $this->goHome();}
        $model = new AdminForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {

            // 生成缓存导航栏文件
            Menu::setNavigation();

            // 到首页去
            return $this->goBack();

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    // 用户退出
    public function actionLogout()
    {
        // 用户退出
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
