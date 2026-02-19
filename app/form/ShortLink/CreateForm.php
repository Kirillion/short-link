<?php

namespace app\form\ShortLink;

use yii\base\Model;

/**
 * @property string $url
 * @property ?string $shortLink
 */
class CreateForm extends Model
{
    private string $url = '';

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): CreateForm
    {
        $this->url = $url;
        return $this;
    }

    public function rules(): array
    {
        return [
            ['url', 'required'],
            [['url'], 'string', 'max' => 2000],
            [['url'], 'url'],
        ];
    }
}