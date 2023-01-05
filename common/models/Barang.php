<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property int $id
 * @property string|null $kode_barang
 * @property string|null $deskripsi
 * @property int|null $harga
 * @property int|null $stok
 * @property float|null $diskon
 * @property int $id_supplier
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deskripsi'], 'string'],
            [['harga', 'stok', 'id_supplier'], 'integer'],
            [['diskon'], 'number'],
            [['id_supplier', 'kode_barang', 'deskripsi'], 'required'],
            [['kode_barang'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_barang' => 'Kode Barang',
            'deskripsi' => 'Deskripsi',
            'harga' => 'Harga',
            'stok' => 'Stok',
            'diskon' => 'Diskon',
            'id_supplier' => 'Id Supplier',
        ];
    }
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'id_supplier']);
    }
}