<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchWallet */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员财务';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-danger">

<div class="box-header width-border"> 
    <div class="box-title" >
        <?= Html::encode($this->title) ?>
    </div>
</div>
    <div class="box-body">

    <h5>会员财务明细</h5>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header'=>'序号'],
            'user.name',
            'user.mobile',
            'user.alipay',
            'amount',
            ['attribute'=>'created_at',
               'label'=>'时间',
              'format'=>['date','php: Y-m-d H:i:s'],
             ],
            ['class' => 'yii\grid\ActionColumn',
            'header'=>'操作',
             'template'=>'{view}'
            ],
        ],
    ]); ?>

</div>
</div>