<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 28.03.2017
 * Time: 19:06
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\Request;


class CategoryController extends AppController{

    public function actionIndex(){
        $hits=Product::find()->where(['hit'=>'1'])->limit(6)->all();
        $this->setMeta('MyShop');
        return $this->render('index',compact('hits'));
    }

    public function actionView($id){
       // $id=Yii::$app->request->get('id'); как вариант

        $category=Category::findOne($id);
        if (empty($category))throw new  \yii\web\HttpException(404,'Такой категории нет!');

        //$products=Product::find()->where(['category_id'=>$id])->all();
        //Pagination
        $query=Product::find()->where(['category_id'=>$id]);
        $pages=new Pagination(['totalCount'=>$query->count(),'pageSize'=>3,'forcePageParam'=>false,
            'pageSizeParam'=>false]);
        $products=$query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('MyShop | '.$category->name, $category->keywords,$category->description);
        return $this->render('view',compact('products', 'pages', 'category'));
    }

    public function actionSearch(){
        $q=trim(Yii::$app->request->get('q'));
        $this->setMeta('MyShop | Поиск: '.$q);
        if (!$q)
            return $this->render('search');//если пустая строка
        $query=Product::find()->where(['like','name',$q]);
        $pages=new Pagination(['totalCount'=>$query->count(),'pageSize'=>3,'forcePageParam'=>false,
            'pageSizeParam'=>false]);
        $products=$query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products','pages','q'));
    }
}