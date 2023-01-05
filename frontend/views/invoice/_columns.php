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
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Pembeli',
        'attribute' => 'id_pembeli',
        'value' => function ($model) {
            return  $model->pembeli->nama_pembeli;
        }
    ],
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
        'attribute' => 'no_faktur',
        'value' => function ($model) {
            return $model->no_faktur;
        }

    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Aksi',
        'template' => '{cetak}',
        'buttons' => [
            "cetak" => function ($url, $model, $key) {
                return Html::a(
                    '<i class="fa fa-file-pdf"></i> Cetak',
                    [
                        'cetak',
                        'id_transaksi' => $model->id,
                        'id_pembeli' => $model->id_pembeli,
                        'no_faktur' => $model->no_faktur,
                    ],
                    ['class' => 'btn btn-success font-weight-normal', 'target' => '_blank', 'data-pjax' => 0]
                );
            },
        ],
        'vAlign' => 'middle',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    // ],
    // 
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'qty',
    // ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'total_bayar',
    //     'value' => function ($model) {
    //         return 'Rp. ' . number_format($model->total_bayar, 2, ",", ".");
    //     }
    // ],

    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'tanggal',
    //     'value' => function ($model) {
    //         return  Yii::$app->formatter->asDate($model->tanggal);
    //     }

    // ],



];