<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Image;
use Yii;
use app\modules\admin\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id){


        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image=UploadedFile::getInstance($model,'image');
            if ($model->image){
                $model->upload();
            }
            unset($model->image);//удаляет переменную
            $model->gallery=UploadedFile::getInstances($model,'gallery');
            $model->uploadGallery();

            Yii::$app->session->setFlash('success',"Товар {$model->name} добавлен");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image=UploadedFile::getInstance($model,'image');
            if ($model->image){
                $model->upload();
            }
            unset($model->image);//удаляет переменную
            $model->gallery=UploadedFile::getInstances($model,'gallery');
            $model->uploadGallery();

            Yii::$app->session->setFlash('success',"Товар обновлен");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelItem($id,$id_img){

       // $id=Yii::$app->request->get('id');

        $model = Product::find()
            ->where(['id' => $id])
            ->one();

        $images = $model->getImages();
        foreach($images as $img){
            if($img->id==$id_img){
                $model->removeImage($img);
            }
        }
        //$success=true;
        Yii::$app->session->setFlash('success',"Фото из галереи удалено!");
        return $this->render('update',compact('model'));

    }



    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}