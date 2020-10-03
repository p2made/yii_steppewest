<?php
/**
 * This is the template for generating the model class of a specified table.
 * DO NOT EDIT THIS FILE! It may be regenerated with Gii.
*/
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var schmunk42\giiant\generators\model\Generator $generator
 * @var string $tableName full table name
 * @var string $className class name
 * @var yii\db\TableSchema $tableSchema
 * @var string[] $labels list of attribute labels (name => label)
 * @var string[] $rules list of validation rules
 * @var array $relations list of relations (name => relation declaration)
 */

echo "<?php\n";
?>
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace <?= $generator->ns ?>\base;

use Yii;
<?php if (isset($translation)): ?>
use dosamigos\translateable\TranslateableBehavior;
<?php endif; ?>
<?php if (!empty($blameable)): ?>
use yii\behaviors\BlameableBehavior;
<?php endif; ?>
<?php if (!empty($timestamp)): ?>
use <?php echo $timestamp['timestampBehaviorClass']; ?>;
<?php endif; ?>

/**
 * This is the base-model class for table "<?= $tableName ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property \<?=$ns?>\<?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 * @property string $aliasModel
 */
abstract class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{

<?php
	$traits = $generator->baseTraits;
	if ($traits) {
		echo "use {$traits};";
	}
?>


<?php
if(!empty($enum)){
?>
	/**
	* ENUM field values
	*/
<?php
	foreach($enum as $column_name => $column_data){
		foreach ($column_data['values'] as $enum_value){
			echo '    const ' . $enum_value['const_name'] . ' = \'' . $enum_value['value'] . '\';' . PHP_EOL;
		}
	}
?>
	var $enum_labels = false;
<?php
}
?>
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '<?= $tableName ?>';
	}
<?php if ($generator->db !== 'db'): ?>

	/**
	 * @return \yii\db\Connection the database connection used by this AR class.
	 */
	public static function getDb()
	{
		return Yii::$app->get('<?= $generator->db ?>');
	}
<?php endif; ?>
<?php if (isset($translation) || !empty($blameable) || !empty($timestamp)): ?>

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
<?php if (!empty($blameable)): ?>
			[
				'class' => BlameableBehavior::className(),
<?php if ($blameable['createdByAttribute'] !== 'created_by'): ?>
				'createdByAttribute' => <?= $blameable['createdByAttribute'] ? "'" . $blameable['createdByAttribute'] . "'" : 'false' ?>,
<?php endif; ?>
<?php if ($blameable['updatedByAttribute'] !== 'updated_by'): ?>
				'updatedByAttribute' => <?= $blameable['updatedByAttribute'] ? "'" . $blameable['updatedByAttribute'] . "'" : 'false' ?>,
<?php endif; ?>
			],
<?php endif; ?>
<?php if (!empty($timestamp)): ?>
			[
				'class' => TimestampBehavior::className(),
<?php if ($timestamp['createdAtAttribute'] !== 'created_at'): ?>
				'createdAtAttribute' => <?= $timestamp['createdAtAttribute'] ? "'" . $timestamp['createdAtAttribute'] . "'" : 'false' ?>,
<?php endif; ?>
<?php if ($timestamp['updatedAtAttribute'] !== 'updated_at'): ?>
				'updatedAtAttribute' => <?= $timestamp['updatedAtAttribute'] ? "'" . $timestamp['updatedAtAttribute'] . "'" : 'false' ?>,
<?php endif; ?>
			],
<?php endif; ?>
<?php if (isset($translation)): ?>
			'translatable' => [
				'class' => TranslateableBehavior::className(),
				// in case you renamed your relation, you can setup its name
				// 'relation' => 'translations',
<?php if ($generator->languageCodeColumn !== 'language'): ?>
				'languageField' => '<?= $generator->languageCodeColumn ?>',
<?php endif; ?>
				'translationAttributes' => [
					<?= "'" . implode("',\n                    '", $translation['fields']) . "'\n" ?>
				],
			],
<?php endif; ?>
		];
	}
<?php endif; ?>

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [<?= "\n            " . implode(",\n            ", $rules) . "\n        " ?>];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
<?php foreach ($labels as $name => $label): ?>
			<?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
		];
	}
<?php if (!empty($hints)): ?>

	/**
	 * @inheritdoc
	 */
	public function attributeHints()
	{
		return array_merge(parent::attributeHints(), [
<?php foreach ($hints as $name => $hint): ?>
			<?= "'$name' => " . $generator->generateString($hint) . ",\n" ?>
<?php endforeach; ?>
		]);
	}
<?php endif; ?>
<?php foreach ($relations as $name => $relation): ?>

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function get<?= $name ?>()
	{
		<?= $relation[0] . "\n" ?>
	}
<?php endforeach; ?>

<?php if (isset($translation)): ?>
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTranslations()
	{
		<?= $translation['code'] . "\n"?>
	}
<?php endif; ?>

<?php if ($queryClassName): ?>
	<?php
	$queryClassFullName = ($generator->ns .'\\base' === $generator->queryNs) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
	echo "\n";
	?>
	/**
	 * @inheritdoc
	 * @return <?= $queryClassFullName ?> the active query used by this AR class.
	 */
	public static function find()
	{
		return new <?= $queryClassFullName ?>(get_called_class());
	}
<?php endif; ?>

<?php
	foreach($enum as $column_name => $column_data){
?>

	/**
	 * get column <?php echo $column_name?> enum value label
	 * @param string $value
	 * @return string
	 */
	public static function <?php echo $column_data['func_get_label_name']?>($value){
		$labels = self::<?php echo $column_data['func_opts_name']?>();
		if(isset($labels[$value])){
			return $labels[$value];
		}
		return $value;
	}

	/**
	 * column <?php echo $column_name?> ENUM value labels
	 * @return array
	 */
	public static function <?php echo $column_data['func_opts_name']?>()
	{
		return [
<?php
		foreach($column_data['values'] as $k => $value){
			echo '            '.'self::' . $value['const_name'] . ' => ' . $generator->generateString($value['label']) . ",\n";
		}
?>
		];
	}
<?php
	}


?>

}
