<?php

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ShortLink $model */
/** @var ActiveForm $form */

try {
    $this->registerJsFile(
            '@web/js/shortLinkCreate.js',
            ['depends' => [\yii\web\JqueryAsset::class]]
    );
} catch (InvalidConfigException $e) {

}
?>

<div class="short-link-index">

    <?php $form = ActiveForm::begin([
            'id' => 'short-link-create-form',
            'action' => ['short-link/create-ajax'],
    ]); ?>

    <?= $form->field($model, 'url') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
