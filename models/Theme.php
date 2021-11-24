<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "themes".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $status
 * @property string $date
 * @property int $user_id
 *
 * @property array $statusToString
 *
 * @property Answer[] $answers
 * @property User $user
 */
class Theme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'themes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['user_id'], 'default', 'value' => Yii::$app->user->getId()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заголовок',
            'text' => 'Текст',
            'status' => 'Статус',
            'date' => 'Дата добавления',
            'user_id' => 'ID пользователя',
        ];
    }

    private $statusToString = [
        0 => 'Отклонена',
        1 => 'Ожидание модерации',
        2 => 'Одобрена'
    ];

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::class, ['theme_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getStatusText()
    {
        return $this->statusToString[$this->status];
    }

    public function approve()
    {
        $this->status = 2;
        $this->save();
    }

    public function reject()
    {
        $this->status = 0;
        $this->save();
    }
}
