<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Transaksi */
?>
<?php if (!Yii::$app->request->isAjax){ ?>
<div class="row">
    <div class="col-md-12">
		<div class="card">
			<div class="card-body">
<?php } ?>
                <div class="transaksi-view">
                    <div class="table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                                        'id',
            'id_barang',
            'id_pembeli',
            'tanggal',
            'keterangan:ntext',
                        ],
                    ]) ?>
                    </div>
                </div>
<?php if (!Yii::$app->request->isAjax){ ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
