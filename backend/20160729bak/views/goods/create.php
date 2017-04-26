<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = '发布商品';
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-white">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'cates'=>$cates,
        'shop'=>$shop
        
    ]) ?>

</div>
