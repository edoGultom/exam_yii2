<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Transaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_barang')->widget(Select2::classname(), [
        'data' => $refBarang,
        'language' => 'id',
        'options' => ['placeholder' => 'Pilih Barang : '],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label('Barang'); ?>
    <?= $form->field($model, 'qty')->textInput() ?>
    <?= $form->field($model, 'no_faktur')->textInput() ?>

    <?= $form->field($model, 'id_pembeli')->widget(Select2::classname(), [
        'data' => $refPembeli,
        'language' => 'id',
        'options' => ['placeholder' => '-Pilih Customer-'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label('Customer'); ?>
    <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => '--Tanggal--',
            'id' => 'tanggal'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ],
    ])->label('Pilih Tanggal');
    ?>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>