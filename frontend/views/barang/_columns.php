<?php

use yii\helpers\Url;

return [
    //[
    //'class' => 'kartik\grid\CheckboxColumn',
    //'width' => '20px',
    //],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kode_barang',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'deskripsi',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'harga',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'stok',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'diskon',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Supplier',
        // 'attribute' => 'supplier.nama_supplier',
        'value' => function ($model) {
            return ($model->supplier) ? $model->supplier->nama_supplier : '';
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'Lihat', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Ubah', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote', 'title' => 'Hapus',
            'data-confirm' => false, 'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Peringatan',
            'data-confirm-message' => 'Apakah anda yakin ingin menghapus data ini?'
        ],
    ],

];