<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property integer $ID
 * @property string $NIP
 * @property string $NAMA
 * @property integer $ID_JABATAN
 * @property string $TLP
 * @property string $EMAIL
 * @property string $ALAMAT
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIP', 'NAMA', 'ID_JABATAN', 'TLP', 'EMAIL', 'ALAMAT'], 'required'],
            [['ID_JABATAN'], 'integer'],
            [['NIP'], 'string', 'max' => 100],
            [['NAMA'], 'string', 'max' => 255],
            [['TLP'], 'string', 'max' => 20],
            [['EMAIL'], 'string', 'max' => 200],
            [['ALAMAT'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIP' => 'Nip',
            'NAMA' => 'Nama',
            'ID_JABATAN' => 'Id  Jabatan',
            'TLP' => 'Tlp',
            'EMAIL' => 'Email',
            'ALAMAT' => 'Alamat',
        ];
    }
}
