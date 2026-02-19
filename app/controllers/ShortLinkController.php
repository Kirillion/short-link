<?php

namespace app\controllers;

use app\form\ShortLink\CreateForm;
use app\service\ShortLink\ShortLinkService;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ShortLinkController extends Controller
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

    public function actionCreate(): string
    {
        $createShortLinkForm = new CreateForm();

        return $this->render(
            'create',
            [
                'model' => $createShortLinkForm
            ]
        );
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionCreateAjax(): string
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $createShortLinkForm = new CreateForm();

        if ($this->request->isPost) {
            $createShortLinkForm->load($this->request->post());
            $this->shortLinkService->create($createShortLinkForm);

            Yii::$app->response->statusCode = $createShortLinkForm->errors == null ? 201 : 400;

            return Json::encode([
                'CreateForm' => [
                    'url' => $createShortLinkForm->url,
                    'shortLink' => $createShortLinkForm->shortLink,
                    'errors' => $createShortLinkForm->errors,
                ]
            ]);
        }

        throw new NotFoundHttpException();
    }
}
