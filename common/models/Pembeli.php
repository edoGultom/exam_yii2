<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pembeli".
 *
 * @property int $id
 * @property string|null $nama_pembeli
 * @property string|null $npwp
 * @property string|null $no_polisi
 * @property string|null $alamat
 */
class Pembeli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembeli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_pembeli', 'alamat'], 'string'],
            [['npwp', 'no_polisi'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_pembeli' => 'Nama Pembeli',
            'npwp' => 'Npwp',
            'no_polisi' => 'No Polisi',
            'alamat' => 'Alamat',
        ];
    }
}
