<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "p2m_subgroup".
 *
 * @property integer $subgroup_id
 * @property integer $group_id
 * @property string $name
 * @property string $title
 * @property integer $hide
 *
 * @property \common\models\Link[] $links
 * @property \common\models\Group $group
 * @property string $aliasModel
 */
abstract class Subgroup extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p2m_subgroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'name', 'title'], 'required'],
            [['group_id', 'hide'], 'integer'],
            [['name', 'title'], 'string', 'max' => 32],
            [['name'], 'unique'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Group::className(), 'targetAttribute' => ['group_id' => 'group_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subgroup_id' => 'Subgroup ID',
            'group_id' => 'Group ID',
            'name' => 'Name',
            'title' => 'Title',
            'hide' => 'Hide',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(\common\models\Link::className(), ['subgroup_id' => 'subgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(\common\models\Group::className(), ['group_id' => 'group_id']);
    }



    /**
     * @inheritdoc
     * @return \common\models\SubgroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\SubgroupQuery(get_called_class());
    }


}
