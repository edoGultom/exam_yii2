<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id
 * @property string|null $tgl_bayar
 * @property int|null $total_bayar
 * @property int $id_transaksi
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_bayar'], 'safe'],
            [['total_bayar', 'id_transaksi'], 'integer'],
            [['id_transaksi'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl_bayar' => 'Tgl Bayar',
            'total_bayar' => 'Total Bayar',
            'id_transaksi' => 'Id Transaksi',
        ];
    }
    public function getTransaksi()
    {
        return $this->hasOne(Transaksi::className(), ['id' => 'id_transaksi']);
    }
}