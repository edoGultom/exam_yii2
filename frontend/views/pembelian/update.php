<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Transaksi */
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="transaksi-update">

                    <?= $this->render('_form', [
                        'refBarang' => $refBarang,
                        'refPembeli' => $refPembeli,
                        'model' => $model,
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>