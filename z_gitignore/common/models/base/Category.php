<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "p2m_category".
 *
 * @property integer $category_id
 * @property string $name
 * @property string $title
 * @property integer $hide
 *
 * @property \common\models\Group[] $groups
 * @property string $aliasModel
 */
abstract class Category extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p2m_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['hide'], 'integer'],
            [['name', 'title'], 'string', 'max' => 32],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'name' => 'Name',
            'title' => 'Title',
            'hide' => 'Hide',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(\common\models\Group::className(), ['category_id' => 'category_id']);
    }



    /**
     * @inheritdoc
     * @return \common\models\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\CategoryQuery(get_called_class());
    }


}
