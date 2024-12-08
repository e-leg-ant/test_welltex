<?php

namespace app\models;

use yii\validators\EmailValidator;

/**
 * This is the model class for table "registration".
 *
 * @property string $key
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $date_added
 */
class Registration extends \yii\db\ActiveRecord
{

    public $agree;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['date_added'], 'safe'],
            [['key'], 'string', 'max' => 32],
            [['first_name', 'last_name'], 'string', 'max' => 200],
            [['mobile'], 'string', 'max' => 17],
            ['email', EmailValidator::class],
            ['email', 'string', 'max' => 200],
            [['key'], 'unique'],
            [['agree'], 'required', 'requiredValue' => 1, 'message' => 'Необходимо дать своё согласие'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Ключ',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'mobile' => 'Мобильный',
            'email' => 'E-mail',
            'date_added' => 'Дата',
        ];
    }
}
