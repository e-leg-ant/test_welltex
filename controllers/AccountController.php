<?php
namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Registration;
use app\models\Order;

/**
 * Account controller
 */
class AccountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['order', 'logout', 'registration', 'login'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['registration', 'confirm-registration', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Registration action.
     *
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionRegistration()
    {
        $model = new Registration();

        if ($model->load(Yii::$app->request->post())) {

            $model->email = trim($model->email);

            $key = md5($model->email . date('Y-m-d H:i:s'));

            $model->key = $key;

            $model->date_added = date('Y-m-d H:i:s');

            if ($model->save()) {

                $link = Yii::$app->urlManager->createAbsoluteUrl(['account/confirm-registration', 'key' => $key], true);

                Yii::$app->session->setFlash('warning', '<span class="fw-bold">Делаем вид, что на ваш ' . $model->email .  '</span> отправлено сообщение с сылкой <a href="' . $link . '" target="_blank">' . $link . '</a> для завершения регистрации');

                return $this->redirect(['site/login']);

            } else {

                Yii::$app->session->setFlash('warning', 'Ошибка.');

                return $this->redirect(['account/registration']);
            }

        } else {

            return $this->render('registration', [
                'model' => $model,
            ]);

        }

    }

    public function actionConfirmRegistration() {

        $key = Yii::$app->request->get('key');

        Yii::$app->view->registerMetaTag(['name' => 'robots',  'content' => 'noindex,nofollow']);

        if (!empty($key)) {

            $modelRegistration = Registration::find()->where(['key' => $key])->one();

            if (!empty($modelRegistration->email)) {

                $modelUser = User::findOne(['email' => $modelRegistration->email]);

                if (empty($modelUser)) {

                    $date = new \DateTime();

                    $modelUser = new User();

                    $password = $modelUser->generatePassword();

                    $modelUser->email = $modelRegistration->email;
                    $modelUser->username = $modelRegistration->email;
                    $modelUser->setPassword($password);
                    $modelUser->generateAuthKey();
                    $modelUser->first_name = $modelRegistration->first_name;
                    $modelUser->last_name = $modelRegistration->last_name;
                    $modelUser->mobile = $modelRegistration->mobile;
                    $modelUser->created_at = $date->getTimestamp();

                    if ($modelUser->save()) {

                        $modelRegistration->delete();

                        Yii::$app->session->setFlash('success', 'Данные для входа. Логин: ' . $modelUser->username . '. Пароль: ' . $password . '. Просили попроще.');

                        return $this->redirect(['site/login']);

                    } else {

                        Yii::$app->session->setFlash('warning',  'Ошибка.');

                        return $this->redirect(['account/registration']);
                    }

                } else {

                    Yii::$app->session->setFlash('warning',  'E-mail ' . $modelRegistration->email . ' уже зарегистрирован в системе.');

                    return $this->redirect(['account/registration']);
                }

            } else {

                Yii::$app->session->setFlash('warning',  'Не указан E-mail.');

                return $this->redirect(['account/registration']);
            }

        } else {

            throw new \yii\web\HttpException('404', 'Такой ссылки не существует');
            return;

        }
    }

    /**
     * Order action.
     *
     * @return string
     */
    public function actionOrder()
    {

        $filterModel = new Order();

        return $this->render('order',  [
            'dataProvider' => $filterModel->searchUser(),
            'filterModel' => $filterModel,
        ]);

    }

}
