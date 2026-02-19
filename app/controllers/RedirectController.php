<?php

namespace app\controllers;

use app\service\ShortLink\ShortLinkService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;


class RedirectController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly ShortLinkService $shortLinkService,
        $config = [],
    )
    {
        parent::__construct($id, $module, $config);
    }

    /**
     * Редирект по короткой ссылке.
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionIndex(): Response
    {
        return $this->redirect(
            $this->shortLinkService->getRedirectUrl(
                Yii::$app->request->getAbsoluteUrl(),
                Yii::$app->request->userIP,
            ),
        );
    }
}
