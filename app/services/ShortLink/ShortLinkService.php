<?php

namespace app\services\ShortLink;

use app\components\CheckerWebResource\CheckerWebResource;
use app\components\RandomStringGenerator\RandomStringGeneratorInterface;
use app\form\ShortLink\CreateForm;
use app\models\RedirectCounter;
use app\models\ShortLink;
use app\services\ShortLink\Exceptions\InvalidUrlResourceException;
use app\services\ShortLink\Exceptions\ResourceNotFoundException;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

readonly class ShortLinkService
{
    public function __construct(
        private RandomStringGeneratorInterface $randomStringGenerator,
        private CheckerWebResource $checkerWebResource,
    )
    {
    }

    /**
     * Сохранит новую короткую ссылку на ресурс
     *
     * @param CreateForm $form
     * @return string
     * @throws Exception
     * @throws InvalidUrlResourceException
     * @throws ResourceNotFoundException
     */
    public function create(CreateForm $form): string
    {
        if ($this->checkerWebResource->check($form->url)) {
            $shortLink = new ShortLink();

            $shortLink->url = $form->url;

            $shortLink->short_url = Url::base('http') . '/';
            $shortLink->short_url .= $this->randomStringGenerator->generate(8);

            $shortLink->created_at = time();

            if ($shortLink->save()) {
                return $shortLink->short_url;
            }

            if ($shortLink->getFirstError('url')) {
                throw new InvalidUrlResourceException();
            }
        }

        throw new ResourceNotFoundException();
    }

    /**
     * Вернет ссылку для редиректа и увеличит счётчик редиректов
     *
     * @param string $shortLink
     * @param string $ipUser
     * @return string
     * @throws NotFoundHttpException|Exception
     */
    public function getRedirectUrl(string $shortLink, string $ipUser): string
    {
        $shortLink = ShortLink::find()
        ->with(['redirectCounters' => function ($query) use ($ipUser) {
            $query->where(['ip' => $ipUser])
            ->indexBy('ip');
        }])
        ->where([
            'short_url' => $shortLink,
            'status' => 1,
        ])
        ->one();

        if ($shortLink == null) {
            throw new NotFoundHttpException();
        }

        if (isset($shortLink->redirectCounters[$ipUser])) {
            $redirectCounter = $shortLink->redirectCounters[$ipUser];

        } else {
            $redirectCounter = new RedirectCounter();

            $redirectCounter->ip = $ipUser;
            $redirectCounter->link('shortLink', $shortLink);
        }

        $redirectCounter->updateCountRedirect();
        if (!$redirectCounter->save()) {
            Yii::error($redirectCounter);
        }

        return $shortLink->url;
    }
}