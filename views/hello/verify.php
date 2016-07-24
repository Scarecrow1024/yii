<?php  use yii\captcha\Captcha;?>
<?= $form->field($model, 'verifyCode')->widget(Captcha::className(),
    ['captchaAction'=>'hello/captcha',
        'imageOptions'=>
        ['alt'=>'点击换图', 'style'=>'cursor:pointer']
    ]) ?>