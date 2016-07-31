<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messaging_group".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property integer $is_active
 *
 * @property MessagingMessageRecipient[] $messagingMessageRecipients
 * @property MessagingUserGroup[] $messagingUserGroups
 */
class MessagingGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messaging_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_date'], 'safe'],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_date' => 'Create Date',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagingMessageRecipients()
    {
        return $this->hasMany(MessagingMessageRecipient::className(), ['recipient_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagingUserGroups()
    {
        return $this->hasMany(MessagingUserGroup::className(), ['group_id' => 'id']);
    }
}
