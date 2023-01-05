<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pembeli */
?>

<div class="row">
    <div class="col-md-12">
		<div class="card">
			<div class="card-body">
                <div class="pembeli-update">

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>

                </div>
             </div>
        </div>
    </div>
</div>
