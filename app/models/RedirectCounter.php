<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "redirect_counter".
 *
 * @property int $id
 * @property int $short_link_id
 * @property string $ip
 * @property int $count_redirection
 *
 * @property ShortLink $shortLink
 */
class RedirectCounter extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'redirect_counter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['count_redirection', 'default', 'value' => 1],
            [['short_link_id', 'ip'], 'required'],
            [['short_link_id', 'count_redirection'], 'integer'],
            ['ip', 'string', 'max' => 15],
            ['ip', 'ip'],
            ['ip', 'unique', 'targetAttribute' => ['ip', 'short_link_id']],
            [['short_link_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShortLink::class, 'targetAttribute' => ['short_link_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'short_link_id' => 'Short Link ID',
            'ip' => 'Ip',
            'count_redirection' => 'Count Redirection',
        ];
    }

    /**
     * Gets query for [[ShortLink]].
     *
     * @return ActiveQuery
     */
    public function getShortLink(): ActiveQuery
    {
        return $this->hasOne(ShortLink::class, ['id' => 'short_link_id']);
    }

    public function updateCountRedirect(): void
    {
        $this->count_redirection++;
    }
}
