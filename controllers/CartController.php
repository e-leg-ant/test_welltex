<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\base\Module;
use yii\helpers\Url;
use app\models\Order;
use app\models\Product;


class CartController extends Controller
{

    /**
     * Class constructor
     *
     * @access public
     * @param string $id id of this controller
     * @param Module $module the module that this controller belongs to. This parameter
     * @return CartController
     */
    public function __construct($id, Module $module = null)
    {
        Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
        parent::__construct($id, $module);
    }

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
                        'actions' => ['index', 'order', 'totals', 'put', 'remove', 'empty'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $newQuantities = Yii::$app->request->post('quantity', []);

        if (!empty($newQuantities) && is_array($newQuantities)) {

            foreach (Yii::$app->cart->getPositions() as $position) {

                if (array_key_exists($position->getId(), $newQuantities)) {
                    Yii::$app->cart->update($position, $newQuantities[$position->getId()]);
                } else {
                    Yii::$app->cart->removeById($position->getId());
                }

            }

            $this->redirect(Url::to(['cart/index']));
        }

        return $this->render('index');
    }

    public function actionPut($id, $quantity = 1)
    {

        $productModel = Product::find()->where(['id' => $id])->one();

        Yii::$app->cart->put($productModel, $quantity);

    }


    public function actionTotals()
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('totals');
        } else {
            throw new \yii\web\HttpException(404, sprintf('Ошибка'));
        }
    }


    public function actionRemove($id)
    {
        if (Yii::$app->cart->hasPosition($id)) {
            Yii::$app->cart->removeById($id);
        }

        $this->redirect(Url::to(['cart/index']));
    }

    public function actionEmpty()
    {
        Yii::$app->cart->removeAll();

        $this->redirect(Url::to(['cart/index']));
    }

    public function actionOrder()
    {

        // Проверяем состав заказа, если заказ пуст, то прерываем отправку заказа и выкидываем ошибку
        if (Yii::$app->cart->getIsEmpty()) {
            Yii::$app->session->setFlash('danger', 'Ошибка при оформлении заказа - Ваша корзина пуста. Вероятнее всего, это произошло из-за того, что Вы пауза между заполнением корзины и оформлением заказа оказалась слишком велика и Ваша корзина была автоматически очищена. Приносим свои искренние извинения за доставленные неудобства.');
            $this->redirect(['cart/index']);
        }

        $user = Yii::$app->user->getIdentity();

        $orderContents = [
            'id_user' => (!empty($user) ? $user->getId() : null),
            'items' => [],
        ];

        foreach (Yii::$app->cart->getPositions() as $position) {

            /** @var IECartPosition $position */

            $orderContents['items'][] = [
                'id' => $position->getId(),
                'name' => $position->name,
                'price' => $position->getPrice(),
                'quantity' => $position->getQuantity(),
                'amount' => $position->getCost(),
                'code' => $position->code,
            ];

        }

        if (!empty($orderContents['items'])) {

            $idOrder = Order::add($orderContents);

            return $this->render('order', [
                'order' => $idOrder,
            ]);

        } else {
            $this->redirect(['cart/index']);
        }


    }

}
