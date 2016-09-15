<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jabatan".
 *
 * @property integer $ID_JABATAN
 * @property string $JABATAN
 */
class Jabatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jabatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['JABATAN'], 'required'],
            [['JABATAN'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_JABATAN' => 'Id  Jabatan',
            'JABATAN' => 'Jabatan',
        ];
    }
}
