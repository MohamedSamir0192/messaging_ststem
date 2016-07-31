<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messaging_user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $create_date
 * @property integer $is_active
 *
 * @property MessagingMessage[] $messagingMessages
 * @property MessagingMessageRecipient[] $messagingMessageRecipients
 * @property MessagingUserGroup[] $messagingUserGroups
 */
class MessagingUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messaging_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['create_date'], 'safe'],
            [['is_active'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'create_date' => 'Create Date',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagingMessages()
    {
        return $this->hasMany(MessagingMessage::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagingMessageRecipients()
    {
        return $this->hasMany(MessagingMessageRecipient::className(), ['recipient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagingUserGroups()
    {
        return $this->hasMany(MessagingUserGroup::className(), ['user_id' => 'id']);
    }
}
