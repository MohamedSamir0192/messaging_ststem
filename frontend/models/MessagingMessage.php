<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messaging_message".
 *
 * @property integer $id
 * @property string $subject
 * @property integer $creator_id
 * @property string $message_body
 * @property string $create_date
 * @property integer $parent_message_id
 * @property string $expiry_date
 *
 * @property MessagingUser $creator
 * @property MessagingMessageRecipient[] $messagingMessageRecipients
 */
class MessagingMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messaging_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'creator_id', 'message_body'], 'required'],
            [['creator_id', 'parent_message_id'], 'integer'],
            [['message_body'], 'string'],
            [['create_date', 'expiry_date'], 'safe'],
            [['subject'], 'string', 'max' => 100],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => MessagingUser::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'creator_id' => 'Creator ID',
            'message_body' => 'Message Body',
            'create_date' => 'Create Date',
            'parent_message_id' => 'Parent Message ID',
            'expiry_date' => 'Expiry Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(MessagingUser::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagingMessageRecipients()
    {
        return $this->hasMany(MessagingMessageRecipient::className(), ['message_id' => 'id']);
    }
}
