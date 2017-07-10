<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 30.03.2017
 * Time: 10:59
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController{

    public function actionView($id){
       // $id=Yii::$app->request->get('id');
        $product=Product::findOne($id);//ленивая загрузка
        if (empty($product))
            throw new  \yii\web\HttpException(404,'Такого товара нет!');
//        $product=Product::find()->with('category')->where(['id'=>$id])->limit(1);//жадная загрузка
        $hits=Product::find()->where(['hit'=>'1'])->limit(6)->all();

        $this->setMeta('MyShop | '.$product->name, $product->keywords,$product->description);

        return $this->render('view',compact('product','hits'));
    }
}
