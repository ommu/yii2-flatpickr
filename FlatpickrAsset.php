<?php
/**
 * Class FlatpickrAsset
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

class FlatpickrAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@ommu/flatpickr/assets';
	
	public $css = [];

	public $js = [
		'js/flatpickr-min.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
		'ommu\flatpickr\FlatpickrPluginAsset',
	];

	public $publishOptions = [
		'forceCopy' => YII_DEBUG ? true : false,
	];
}