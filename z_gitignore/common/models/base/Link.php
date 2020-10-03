<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "p2m_link".
 *
 * @property integer $link_id
 * @property integer $subgroup_id
 * @property string $name
 * @property string $title
 * @property string $link
 * @property integer $https
 * @property integer $hide
 *
 * @property \common\models\Subgroup $subgroup
 * @property string $aliasModel
 */
abstract class Link extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p2m_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subgroup_id', 'title', 'link'], 'required'],
            [['subgroup_id', 'https', 'hide'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 64],
            [['link'], 'string', 'max' => 255],
            [['subgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Subgroup::className(), 'targetAttribute' => ['subgroup_id' => 'subgroup_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'link_id' => 'Link ID',
            'subgroup_id' => 'Subgroup ID',
            'name' => 'Name',
            'title' => 'Title',
            'link' => 'Link',
            'https' => 'Https',
            'hide' => 'Hide',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubgroup()
    {
        return $this->hasOne(\common\models\Subgroup::className(), ['subgroup_id' => 'subgroup_id']);
    }



    /**
     * @inheritdoc
     * @return \common\models\LinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\LinkQuery(get_called_class());
    }


}
