<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Supplier */
?>
<?php if (!Yii::$app->request->isAjax){ ?>
<div class="row">
    <div class="col-md-12">
		<div class="card">
			<div class="card-body">
<?php } ?>
                <div class="supplier-view">
                    <div class="table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                                        'id',
            'nama_supplier:ntext',
            'no_telp',
            'alamat:ntext',
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
