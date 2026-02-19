<?php

namespace app\service\ShortLink;

use app\form\ShortLink\CreateForm;
use app\models\ShortLink;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class ShortLinkService
{
    /**
     * Сохранит новую короткую ссылку на ресурс
     *
     * @param CreateForm $form
     * @return void
     * @throws \yii\base\Exception
     * @throws Exception
     */
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

    /**
     * Вернет ссылку для редиректа и увеличит счётчик редиректов
     *
     * @param string $shortLink
     * @return string
     * @throws NotFoundHttpException
     */
    public function getRedirectUrl(string $shortLink): string
    {
        $shortLink = ShortLink::findOne(['short_url' => $shortLink]);

        if ($shortLink == null) {
            throw new NotFoundHttpException();
        }

        //TODO: Сделать счетчик

        return $shortLink->url;
    }
}