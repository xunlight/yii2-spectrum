# yii2-spectrum

Implementation of "Spectrum The No Hassle Colorpicker" https://github.com/bgrins/spectrum in Yii2

Usage in active form

```PHP
  <?= $form->field($model, 'color')->widget('\xunlight\spectrum\Spectrum', [
      'cdn' => true, // default is false
      // configure additional widget properties here
      'clientOptions' => [ 'chooseText' => 'Select Color!' ],
      // configure additional widget events here
      'clientEvents' => [ 
                          'change' => 'function(color) {
                              console.log(color.toHexString());
                          }'
                        ],
  ]) ?>
```

Solo Usage as widget

```PHP
  <?= Spectrum::widget([
    'name'  => 'abc',
    'value' => '#fff,
    // configure additional widget properties here
    'clientOptions' => [ 'chooseText' => 'Select Color!' ],
    // configure additional widget events here
    'clientEvents' => [ 
                          'change' => 'function(color) {
                              console.log(color.toHexString());
                          }'
                          ]
                      ]) ?>
```
