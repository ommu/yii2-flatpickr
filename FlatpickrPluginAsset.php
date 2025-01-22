<?php
/**
 * Class FlatpickrPluginAsset
 * @package ommu\flatpickr
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 11 August 2020, 13:47 WIB
 * @link https://github.com/ommu/yii2-flatpickr
 *
 */

namespace ommu\flatpickr;

class FlatpickrPluginAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@npm/flatpickr/dist';
	
	public $css = [
		'flatpickr.min.css',
	];

	public $js = [
		'flatpickr.min.js',
	];

	public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

	public $publishOptions = [
		'forceCopy' => YII_DEBUG ? true : false,
	];
}