<?php
/**
 * AppAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright &copy; Pedro Plowman, 2017
 * @link https://github.com/p2made
 * @package p2made/yii2-a6e
 * @license MIT
 */

/**
 * Load this asset with...
 * frontend\assets\AppAsset::register($this);
 *
 * or specify as a dependency with...
 *	 'frontend\assets\AppAsset',
 */

namespace frontend\assets;

class AppAsset extends \p2m\assets\base\P2AssetBundle
{
	private $resourceData = array(

		'published' => [
			'sourcePath' => '@frontend/assets/lib',
			'css' => [
				'css/full.min.css',
			],
			'js' => [
			],
		],

		'depends' => [
			'p2made\assets\P2CoreAsset',
		],
	);

	public function init()
	{
		$this->configureAsset($this->resourceData);
		parent::init();
	}
}
