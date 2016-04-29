<?php
/*
* Simple widget for The No hassle colorpicker
* 
* @package      Spectrum
* @author       Xunlight <xelo.cz@gmail.com>
* @copyright    2016 Xunlight
* @version      1.0.0
* 
* @class        Spectrum
*
* @description
* 
* Some info about jsquery plugin ->http://bgrins.github.io/spectrum/
* 
*/
namespace xunlight\spectrum;
use Yii;
use yii\helpers\html;
class Spectrum extends \yii\widgets\InputWidget
{
    /**
     * @var string type of the input tag. (e.g. 'text', 'password')
     */
    public $inputType = 'text';
    
    /**
     * @var boolean if You want to use CDN for assets
     */
    public $cdn = false;
    
    /**
     * @var string cdn location of files
     */
    public $cdnJS  = 'https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js';
    public $cdnCSS = 'https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css';


    /**
     * @var array the options for the Spectrum JS plugin.
     * Please refer to the Spectrum JS plugin Web page for possible options.
     * @see http://bgrins.github.io/spectrum/#options
     * 
        {
            //# Options
            color: tinycolor,
            flat: bool,
            showInput: bool,
            showInitial: bool,
            allowEmpty: bool,
            showAlpha: bool,
            disabled: bool,
            localStorageKey: string,
            showPalette: bool,
            showPaletteOnly: bool,
            togglePaletteOnly: bool,
            showSelectionPalette: bool,
            clickoutFiresChange: bool,
            cancelText: string,
            chooseText: string,
            togglePaletteMoreText: string,
            togglePaletteLessText: string,
            containerClassName: string,
            replacerClassName: string,
            preferredFormat: string,
            maxSelectionSize: int,
            palette: [[string]],
            selectionPalette: [string],
            
            //# Events
            move: function(tinycolor) { },
            show: function(tinycolor) { },
            hide: function(tinycolor) { },
            beforeShow: function(tinycolor) { },
        }
     */
    public $clientOptions = [];
    
    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeInput( $this->inputType, $this->model, $this->attribute, $this->options );
        } else {
            echo Html::input($this->inputType, $this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * Registers Spectrum js plugin
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        
        //include assets
        if($this->cdn){//cdn
            $view->registerJsFile( $this->cdnJS, ['depends'=>'yii\web\JqueryAsset'] );
            $view->registerCssFile( $this->cdnCSS );
        }else{//locally
            SpectrumAsset::register( $view );
        }
        
        //JS init function
        $id = $this->options['id'];
        $options =  json_encode($this->clientOptions);
        $view->registerJs( "$('#{$id}').spectrum($options);" );
    }
    
    
}
/**
 * Asset bundle for Spectrum
 *
 * @author xunlight
 * @since 1.0
 */
class SpectrumAsset extends \yii\web\AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    
    // public $sourcePath = '@vendor/bgrins/spectrum';

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . '/assets/';
        $this->js[]  = 'spectrum.js';
        $this->css[] = 'spectrum.css';
        parent::init();
    }
}
