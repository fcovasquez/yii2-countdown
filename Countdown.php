<?php

namespace fcovasquez\widgets;

use fcovasquez\widgets\CountdownAsset;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;

class Countdown extends Widget
{
    /**
     * @var string
     */
    public $datetime;

    /**
     * @var string
     */
    public $format = '%H:%M:%S';

    /**
     * @var array
     */
    public $events = [];

    /**
     * @var array
     */
    public $options = [];

    /**
     * @var array
     */
    public $config = [];
    
    /**
     * @var string
     */
    public $tagName = 'span';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->datetime)
            throw new InvalidConfigException('Datetime parameter must be specified');

        $view = $this->getView();
        CountdownAsset::register($view);

        $view->registerJs($this->renderScript());

        $this->options['id'] = $this->id;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $script = '';
        if (Yii::$app->request->isAjax)
            $script = Html::tag('script', $this->renderScript());

        return Html::tag($this->tagName, '', $this->options) . $script;
    }

    /**
     * @return string
     */
    protected function renderScript()
    {
        $config = '{';
        foreach ($this->config as $key => $value) {
            $config .= $key .': ' . $value . ',';
        }
        $config .= '}';
        $script = 'jQuery("#' . $this->id . '").countdown("' . $this->datetime
            . '", ' . $config . ', function(e) {$(this).html(e.strftime("' . $this->format . '"))})';

        foreach ($this->events as $event => $callback)
            $script .= '.on("' . $event . '.countdown", ' . $callback . ')';

        return $script;
    }
}
