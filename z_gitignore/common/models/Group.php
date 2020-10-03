<?php

namespace common\models;

use Yii;
use \common\models\base\Group as BaseGroup;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "p2m_group".
 */
class Group extends BaseGroup
{
	use \mootensai\relation\RelationTrait;

	public function behaviors()
	{
		return ArrayHelper::merge(
			parent::behaviors(),
			[
				# custom behaviors
			]
		);
	}

	public function rules()
	{
		return ArrayHelper::merge(
			parent::rules(),
			[
				# custom validation rules
			]
		);
	}
}
