<?php

namespace app\controllers;

use app\form\ShortLink\CreateForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class ShortLinkController extends Controller
{
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

    public function actionCreateAjax(): void
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $createShortLinkForm = new CreateForm();

        if ($this->request->isPost) {
            $createShortLinkForm->load($this->request->post());
            //TODO: Подключаем сервис
        }


    }
}
