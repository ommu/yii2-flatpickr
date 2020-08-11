<?php
/**
 * Class Flatpickr
 * @package ommu\flatpickr
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 11 August 2020, 14:29 WIB
 * @link https://github.com/ommu/yii2-flatpickr
 *
 */

namespace ommu\flatpickr;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use ommu\flatpickr\FlatpickrAsset;
use ommu\flatpickr\FlatpickrPluginAsset;

class Flatpickr extends \yii\widgets\InputWidget
{
    /**
     * @var array the HTML attributes for the form input
     */
    public $options = ['class' => 'form-control'];

    /**
     * {@inheritdoc}
     */
    public $pluginName = 'flatpickr';

    /**
     * {@inheritdoc}
     */
    public $theme;

    /**
     * {@inheritdoc}
     */
    public $placeholder;

    /**
     * @var array Flatpickr options
     * @link https://flatpickr.js.org/options/
     */
    public $clientOptions = [];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // add data-toggle attribute
        $this->options = ArrayHelper::merge($this->options, ['data-toggle' => $this->pluginName]);

        // add placeholder attribute
        if (isset($this->placeholder)) {
            $this->options = ArrayHelper::merge($this->options, ['placeholder' => $this->placeholder]);
        }

        if (is_array($this->clientOptions) && !empty($this->clientOptions)) {
            $this->options = ArrayHelper::merge($this->options, $this->getAttributeData($this->clientOptions));
        }

        // set value from query params
        $queryParams = Yii::$app->request->queryParams;
        if (is_array($queryParams) && !empty($queryParams) && array_key_exists($this->getInputId(), $queryParams)) {
            $this->options = ArrayHelper::merge($this->options, ['value' => Yii::$app->request->get($this->getInputId())]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->registerAssets();
        $this->renderContent();
    }

    /**
     * Return input id
     *
     * @return string
     */
    public function getInputId(): string
    {
        return $this->options['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeData($data): array
    {
        foreach ($data as $key => $val) {
            if ($val == '') {
                continue;
            }

            $newKey = join('-', ['data', $this->pluginName, Inflector::camel2id($key)]);
            if (is_bool($val)) {
                $val = $val == true ? 'true' : 'false';
            }
            $data[$newKey] = $val;

            unset($data[$key]);
        }

        return $data;
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        FlatpickrAsset::register($view);

        $flatpickrPluginAsset = FlatpickrPluginAsset::register($view);

        $view->registerCssFile(join('/', [$flatpickrPluginAsset->baseUrl, 'themes', ($this->theme ? $this->theme : 'airbnb')]).'.css', ['depends' => [FlatpickrPluginAsset::className()]]);
    }

    /**
     * Renders widget
     */
    private function renderContent()
    {
        $options = ArrayHelper::merge($this->options, ['id' => $this->id]);

        echo $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $options)
            : Html::textInput($this->name, $this->value, $options);
    }
}
