<?php

namespace common\models\generated\models;

use Yii;

/**
 * This is the model class for table "i18n_message".
 *
 * @property int $id
 * @property string $language
 * @property string|null $translation
 *
 * @property I18nSourceMessage $id0
 */
class I18nMessage extends \common\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i18n_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id', 'language'], 'unique', 'targetAttribute' => ['id', 'language']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => I18nSourceMessage::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
            'translation' => 'Translation',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\generated\query\I18nSourceMessageQuery
     */
    public function getId0()
    {
        return $this->hasOne(I18nSourceMessage::className(), ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\generated\query\I18nMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\generated\query\I18nMessageQuery(get_called_class());
    }
}
