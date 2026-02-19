<?php

use yii\base\InvalidConfigException;
use yii\bootstrap5\BootstrapPluginAsset;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ShortLink $model */
/** @var ActiveForm $form */

try {
    $this->registerJsFile(
            '@web/js/shortLinkCreate.js',
            ['depends' =>
                    [
                            JqueryAsset::class,
                            BootstrapPluginAsset::class,
                    ]
            ]
    );

    $this->registerJsFile(
            'https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js',
            ['depends' => [JqueryAsset::class]]
    );
} catch (InvalidConfigException $e) {

}
?>

<div class="short-link-index d-flex align-items-center justify-content-center min-vh-100">

    <div class="w-50">
        <?php $form = ActiveForm::begin([
                'id' => 'short-link-create-form',
                'action' => ['short-link/create-ajax'],
        ]); ?>
        <div class="row">

            <div class="col-9">
                <?= $form->field($model, 'url')
                        ->textInput([
                                'placeholder' => 'Введите ссылку, которую хотите сократить',
                                'class' => 'form-control form-control-lg',
                        ])->label(false) ?>
            </div>

            <div class="col-1">
                <div class="form-group">
                    <?= Html::submitButton('ОК', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
            </div>

        </div>
        <?php ActiveForm::end(); ?>

        <div class="accordion d-none" id="accordion-short-link">
            <div class="accordion-item">
                <div id="collapse-short-link" class="accordion-collapse collapse" aria-labelledby="heading-short-link"
                     data-bs-parent="#accordion-short-link">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-9">
                                <p type="text" id="short-url" class="text-center fs-3">&nbsp;</p>
                            </div>
                            <div class="col-1">
                                <button id="copy-short-link" class="btn btn-primary btn-lg" disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div id="qr-wrapper" class="d-flex justify-content-center align-items-center my-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
