<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "short_link".
 *
 * @property int $id
 * @property string $url
 * @property string $short_url
 * @property int $created_at
 */
class ShortLink extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'short_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['url', 'short_url', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['url', 'short_url'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'short_url' => 'Short Url',
            'created_at' => 'Created At',
        ];
    }
}
