<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_sisa_makanan".
 *
 * @property int $id
 * @property int|null $id_pasien
 * @property int|null $id_jenis_makanan
 * @property int|null $id_sisa_makanan
 * @property int|null $nilai
 * @property int|null $jumlah
 * @property int|null $dikalikan
 * @property float|null $persentasi_skor
 */
class TaSisaMakanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_sisa_makanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pasien', 'id_jenis_makanan', 'id_sisa_makanan', 'nilai', 'jumlah', 'dikalikan'], 'integer'],
            [['persentasi_skor'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pasien' => 'Id Pasien',
            'id_jenis_makanan' => 'Id Jenis Makanan',
            'id_sisa_makanan' => 'Id Sisa Makanan',
            'nilai' => 'Nilai',
            'jumlah' => 'Jumlah',
            'dikalikan' => 'Dikalikan',
            'persentasi_skor' => 'Persentasi Skor',
        ];
    }
}