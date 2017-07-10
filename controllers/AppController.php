<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 28.03.2017
 * Time: 19:06
 */

namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller{
    public function debug($arr){
        echo '<pre>'.print_r($arr,true).'</pre>';
    }

    protected function setMeta($title=null, $keywords=null, $description=null ){
        $this->view->title=$title;
        $this->view->registerMetaTag(['name'=>'keywords','content'=>"$keywords"]);
        $this->view->registerMetaTag(['name'=>'description','content'=>"$description"]);
}
}