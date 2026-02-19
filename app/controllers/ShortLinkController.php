<?php

namespace app\controllers;

use app\form\ShortLink\CreateForm;
use app\services\ShortLink\Exceptions\InvalidUrlResourceException;
use app\services\ShortLink\Exceptions\ResourceNotFoundException;
use app\services\ShortLink\ShortLinkService;
use Yii;
use yii\db\Exception;
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
                'model' => $createShortLinkForm,
            ],
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

            try {
                $url = $this->shortLinkService->create($createShortLinkForm);

                Yii::$app->response->statusCode = 201;

                return Json::encode([
                    'data' => [
                        'url' => $url,
                    ],
                ]);

            } catch (InvalidUrlResourceException|ResourceNotFoundException $e) {
                Yii::$app->response->statusCode = 400;

                return Json::encode([
                    'error' => $e->getMessage(),
                ]);

            } catch (Exception $e) {
                Yii::$app->response->statusCode = 400;

                return Json::encode([
                    'error' => 'Возникла непредвиденная ошибка сервера.',
                ]);
            }
        }

        throw new NotFoundHttpException();
    }
}
