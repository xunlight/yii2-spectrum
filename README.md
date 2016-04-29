# yii2-spectrum

Implementation of "Spectrum The No Hassle Colorpicker" https://github.com/bgrins/spectrum in Yii2

Ussage in active form

```PHP
  <?= $form->field($model, 'color')->widget('\xunlight\spectrum\Spectrum', [
      'cdn' => true, // default is false
      // configure additional widget properties here
      'clientOptions' => [ 'chooseText' => 'Select Color!' ]
  ]) ?>
```
