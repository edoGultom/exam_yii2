<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id
 * @property int $id_barang
 * @property int $id_pembeli
 * @property string|null $tanggal
 * @property string|null $keterangan
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang', 'id_pembeli'], 'required'],
            [['id_barang', 'id_pembeli', 'qty', 'total_bayar'], 'integer'],
            [['tanggal'], 'safe'],
            [['keterangan', 'no_faktur'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_barang' => 'Id Barang',
            'no_faktur' => 'No Faktur',
            'id_pembeli' => 'Id Pembeli',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
            'qty' => 'Quantity',
            'total_bayar' => 'Total',
        ];
    }
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'id_barang']);
    }
    public function getPembeli()
    {
        return $this->hasOne(Pembeli::className(), ['id' => 'id_pembeli']);
    }
    public function getPembayaran()
    {
        return $this->hasOne(Pembayaran::className(), ['id_transaksi' => 'id']);
    }
}