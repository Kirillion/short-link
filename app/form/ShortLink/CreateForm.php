<?php

namespace app\form\ShortLink;

use yii\base\Model;

class CreateForm extends Model
{
    private string $url = '';
    private ?string $shortLink = null;

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): CreateForm
    {
        $this->url = $url;
        return $this;
    }

    public function getShortLink(): ?string
    {
        return $this->shortLink;
    }

    public function setShortLink(?string $shortLink): CreateForm
    {
        $this->shortLink = $shortLink;
        return $this;
    }

    public function rules(): array
    {
        return [
            ['url', 'required'],
            [['url', 'short_url'], 'string', 'max' => 2000],
            [['url', 'short_url'], 'url'],
        ];
    }
}