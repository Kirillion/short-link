<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "short_link".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $short_url
 * @property int $created_at
 * @property int|null $status
 *
 * @property RedirectCounter[] $redirectCounters
 */
class ShortLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'short_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'short_url'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['created_at'], 'required'],
            [['created_at', 'status'], 'integer'],
            [['url', 'short_url'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'short_url' => 'Short Url',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[RedirectCounters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRedirectCounters()
    {
        return $this->hasMany(RedirectCounter::class, ['short_link_id' => 'id']);
    }
}
