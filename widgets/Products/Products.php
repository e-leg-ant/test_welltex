<?php

namespace app\widgets\Products;

use app\models\Category;
use app\models\Product;
use yii\bootstrap5\Widget;

class Products extends Widget
{

    public string $view;

    public function run()
    {

        $view = (!empty($this->view)) ? $this->view : 'list';

        $categories = Category::find()->all();

        return $this->render($view, [
            'categories' => $categories,
        ]);

    }
}