<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messaging_user_group".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $group_id
 * @property string $create_date
 * @property integer $is_active
 *
 * @property MessagingGroup $group
 * @property MessagingUser $user
 */
class MessagingUserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messaging_user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'required'],
            [['user_id', 'group_id', 'is_active'], 'integer'],
            [['create_date'], 'safe'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => MessagingGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MessagingUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
            'create_date' => 'Create Date',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(MessagingGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(MessagingUser::className(), ['id' => 'user_id']);
    }
}
