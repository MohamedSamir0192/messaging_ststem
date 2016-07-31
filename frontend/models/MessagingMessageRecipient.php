<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messaging_message_recipient".
 *
 * @property integer $id
 * @property integer $recipient_id
 * @property integer $recipient_group_id
 * @property integer $message_id
 * @property integer $is_read
 *
 * @property MessagingMessage $message
 * @property MessagingGroup $recipientGroup
 * @property MessagingUser $recipient
 */
class MessagingMessageRecipient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messaging_message_recipient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipient_id', 'recipient_group_id', 'message_id', 'is_read'], 'integer'],
            [['message_id', 'is_read'], 'required'],
            [['message_id'], 'exist', 'skipOnError' => true, 'targetClass' => MessagingMessage::className(), 'targetAttribute' => ['message_id' => 'id']],
            [['recipient_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => MessagingGroup::className(), 'targetAttribute' => ['recipient_group_id' => 'id']],
            [['recipient_id'], 'exist', 'skipOnError' => true, 'targetClass' => MessagingUser::className(), 'targetAttribute' => ['recipient_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recipient_id' => 'Recipient ID',
            'recipient_group_id' => 'Recipient Group ID',
            'message_id' => 'Message ID',
            'is_read' => 'Is Read',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(MessagingMessage::className(), ['id' => 'message_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipientGroup()
    {
        return $this->hasOne(MessagingGroup::className(), ['id' => 'recipient_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient()
    {
        return $this->hasOne(MessagingUser::className(), ['id' => 'recipient_id']);
    }
}
