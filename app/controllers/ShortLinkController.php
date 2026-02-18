<?php

namespace app\controllers;

class ShortLinkController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
