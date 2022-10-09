<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_pasien".
 *
 * @property int $id_pasien
 * @property string|null $nama
 * @property string|null $no_rm
 * @property string|null $tgl_lahir
 * @property string|null $tgl_audit
 * @property string|null $waktu_makan
 * @property string|null $siklus
 * @property string|null $jenis_diet
 * @property string|null $ruangan
 */
class TaPasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'siklus', 'jenis_diet', 'ruangan'], 'string'],
            [['tgl_lahir', 'tgl_audit'], 'safe'],
            [['no_rm'], 'string', 'max' => 25],
            [['waktu_makan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pasien' => 'Id Pasien',
            'nama' => 'Nama',
            'no_rm' => 'No Rm',
            'tgl_lahir' => 'Tgl Lahir',
            'tgl_audit' => 'Tgl Audit',
            'waktu_makan' => 'Waktu Makan',
            'siklus' => 'Siklus',
            'jenis_diet' => 'Jenis Diet',
            'ruangan' => 'Ruangan',
        ];
    }
    public function getIsPasien()
    {
        $model = TaSisaMakanan::find()->where(['id_pasien' => $this->id_pasien])->count();
        if ($model >= 4) {
            return true;
        }
        return false;
    }
}