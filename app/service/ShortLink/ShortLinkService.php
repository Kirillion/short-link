<?php

namespace app\service\ShortLink;

use app\form\ShortLink\CreateForm;
use app\models\ShortLink;
use Yii;
use yii\helpers\Url;

class ShortLinkService
{
    public function create(CreateForm $form): void
    {
        $shortLink = new ShortLink();

        $shortLink->url = $form->url;
        //TODO: Сделать генератор сокращенной ссылки
        $shortLink->short_url = Url::base('http') . '/' .Yii::$app->security->generateRandomString();
        $shortLink->created_at = time();

        if ($shortLink->save()) {
            $form->shortLink = $shortLink->short_url;
        }

        $form->addErrors($shortLink->errors);
    }
}