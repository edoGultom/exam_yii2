<?php

use yii\helpers\Url;
use yii\helpers\Html;

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
        // 'attribute' => 'id_barang',
        'format' => 'raw',
        'header' => 'Barang',
        'value' => function ($model) {
            return ($model->barang) ? '<b>KODE : ' . $model->barang->kode_barang . '  - Rp. ' . number_format($model->barang->harga, 2, ",", ".") . ' - Disc. (' . $model->barang->diskon . '%)</b></br>' . $model->barang->deskripsi . '</br>'  : '';
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Pembeli',
        // 'attribute'=>'id_pembeli',
        'value' => function ($model) {
            return ($model->pembeli) ? $model->pembeli->nama_pembeli : '';
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'no_faktur',
        'value' => function ($model) {
            return $model->no_faktur;
        }

    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggal',
        'value' => function ($model) {
            return  Yii::$app->formatter->asDate($model->tanggal);
        }

    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'keterangan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'total_bayar',
        'value' => function ($model) {
            return 'Rp. ' . number_format($model->total_bayar, 2, ",", ".");
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Data',
        'template' => '{bayar}',
        'buttons' => [
            "bayar" => function ($url, $model, $key) {
                if ($model->pembayaran) {
                    return 'Sdah Bayar';
                }
                return Html::a('Bayar', ['bayar', 'id_transaksi' => $model->id], [
                    'class' => 'btn btn-warning btn-block',
                    'role' => 'modal-remote', 'title' => 'Bayar',
                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Peringatan',
                    'data-confirm-message' => 'Apakah anda yakin ingin membayar ???'
                ]);
            },
        ],
        'vAlign' => 'middle',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'visibleButtons' => [
            'delete' => function ($model) {
                return (!$model->pembayaran) ? true : false;
            },
            'update' => function ($model) {
                return (!$model->pembayaran) ? true : false;
            },
        ],
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