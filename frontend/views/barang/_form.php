<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model common\models\Barang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_barang')->textInput() ?>
    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'harga')->textInput() ?>
    <!-- <?= $form->field($model, 'harga')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'Rp. ',
                    'suffix' => '',
                    'precision' => 0,
                    'id' => 'harga',
                    'allowClear' => false,
                    'showMaskOnFocus' => false,
                    'showMaskOnHover' => false
                ],
                'options' => [
                    'placeholder' => 'Rp. 0',
                ],
            ]) ?> -->

    <?= $form->field($model, 'stok')->textInput() ?>
    <?= $form->field($model, 'diskon')->textInput(['placeHolder' => 'ex: 10'])->label("Diskon (%)") ?>

    <?= $form->field($model, 'id_supplier')->widget(Select2::classname(), [
        'data' => $dataSupplier,
        'language' => 'id',
        'options' => ['placeholder' => 'Pilih Supplier : '],
        'pluginOptions' => [
            'allowClear' => true,
        ],

    ])->label('Supplier'); ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>