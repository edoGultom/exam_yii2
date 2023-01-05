<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Barang */
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="barang-update">

                    <?= $this->render('_form', [
                        'model' => $model,
                        'dataSupplier' => $dataSupplier,
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>