<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

<!--    --><?//= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>
    <div class="form-group field-product-category_id has-success">
        <label class="control-label" for="product-category_id">Родительская категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]">
            <?= \app\components\MenuWidget::widget(['tpl'=>'select_product','model'=>$model])?>
        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
      echo $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
    ]);
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <hr>
    <div class="addPhoto">
        <h4><a >Добавление фото(подсказка)</a></h4>
        <p>При отсуцтвии главной фотографии - главной будет первая из галлереи.</p>
    </div>

    <h2>Главное фото</h2>
    <?= "<img src='{$model->getImage()->getUrl()}'>"?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <hr>
    <h2>Галлерея</h2>

    <?php
    $img = $model->getImage();
    $gallery = $model->getImages();
    ?>
     <div class="row">
    <?php foreach ($gallery as $img_g): ?>
       <?php $url_delete=Url::toRoute(['product/del-item', 'id' => $model->id, 'id_img' => $img_g->id]);?>
         <div class="col-xs-6 col-md-3">

                 <?php if(!$model->isNewRecord): ?>
                 <div  class="thumbnail reshenie_image_form">
                     <a class="btn delete_img" title="Удалить?" href="<?= $url_delete ?>" data-id="'.$img_g->id.'"><span class="glyphicon glyphicon-remove"></span></a>
                     <?php endif ?>
                 <a class="fancybox img-rounded" rel="gallery1" href="<?= $img_g->getUrl()?>"><?= Html::img($img_g->getUrl('x100'), ['alt' => ''])?></a>
             </div>
         </div>

    <?php endforeach; ?>
    </div>



<!--    --><?php
//    $gallery=$model->getImages();
//    //$g=null;
//    $i=0;
//    foreach ($gallery as $gall){
//        $i++;
//        if ($i==1)continue;
//        echo "<img src='{$gall->getUrl('x70')}'>";
//    }
//    ?>
    <?= $form->field($model, 'gallery[]')->fileInput(['multiple'=>true,
        'accept'=>'image/*']) ?>
    <hr>
    <?= $form->field($model, 'hit')->checkbox([ '0', '1', ]) ?>

    <?= $form->field($model, 'new')->checkbox([ '0', '1', ]) ?>

    <?= $form->field($model, 'sale')->checkbox([ '0', '1', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
