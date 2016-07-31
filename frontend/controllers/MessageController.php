<?php
namespace frontend\controllers;
use Yii;
use app\models\MessagingUser;
use app\models\MessagingMessage;
use app\models\MessagingMessageRecipient;
use app\models\MessagingGroup;
use app\models\MessagingUserGroup;
use yii\web\Controller;
use yii\web\Session;
use yii\db\Transaction;
use yii\db\Connection;
use yii\db\Query;

class MessageController extends Controller{




	public function beforeAction($action) { 
		$this->enableCsrfValidation = false; 
		return parent::beforeAction($action); 
	}

	public function actionReply(){
		$connection = \Yii::$app->db;
		$transaction = $connection->beginTransaction();
		$parent_msg = MessagingMessageRecipient::find()
							->where(['message_id' =>  $_GET['msg_id']])
							->One();
		if($_POST){
			try{
				$message = new MessagingMessage;
				//$message->attribures = $_POST['Message'];
				$message->creator_id = $_POST['Message']['creator_id'];
				$message->subject = $_POST['Message']['subject'];
				$message->message_body = $_POST['Message']['message_body'];
				$message->parent_message_id = $_GET['msg_id'];
				if($message->save()){
					$recipient = new MessagingMessageRecipient;
					$recipient->message_id = $message->id;
					if($parent_msg->recipient_id)
						$recipient->recipient_id = $parent_msg->message->creator_id;

					$recipient->recipient_group_id = $parent_msg->recipient_group_id;
					$recipient->is_read = 0;
					if($recipient->save())
						$transaction->commit();
				}
			}catch(\Exception $e) {
    			$transaction->rollBack();
    			throw $e;
			}
		}

		$user_id = Yii::$app->params['user_id'];
		return $this->render('reply', [
             'parent_msg' => $parent_msg,
             'user_id' => $user_id
        ]);
        
	}

	public function actionIndex(){
		$connection = \Yii::$app->db;
		$transaction = $connection->beginTransaction();
		if($_POST){
			try{
				$message = new MessagingMessage;
				//$message->attribures = $_POST['Message'];
				$message->creator_id = $_POST['Message']['creator_id'];
				$message->subject = $_POST['Message']['subject'];
				$message->message_body = $_POST['Message']['message_body'];
				if($message->save()){
					$is_group_message = false;
					if($_POST['group_name']){
						$group = new MessagingGroup;
						$is_group_message = true;
						$group->name = $_POST['group_name'];
						$group->save();
						$recipients = explode(",", $_POST['recipient_id']);
						$user_group = new MessagingUserGroup;
						$user_group->user_id = $_POST['Message']['creator_id'];
						$user_group->group_id = $group->id;
						$user_group->save();
						foreach ($recipients as $rec) {
							$user_group = new MessagingUserGroup;
							$user_group->user_id = $rec;
							$user_group->group_id = $group->id;
							$user_group->save();
						}

					}
					$recipient = new MessagingMessageRecipient;
					if($is_group_message)
						$recipient->recipient_group_id = $group->id;
					else	
						$recipient->recipient_id = $_POST['recipient_id'];
					$recipient->message_id = $message->id;
					$recipient->is_read = 0;
					if($recipient->save())
						$transaction->commit();
					
				}
			}
			catch(\Exception $e) {
    			$transaction->rollBack();
    			throw $e;
			}
		}
			
		//$session = new Session;
		//$session->open();
		//$session['userId'] = 2;
		Yii::$app->view->params['user_id'] = 2;
		/*if(!isset($session['userId'])){
			$session['userId'] = 2;
		}*/
		$id = Yii::$app->params['user_id'];
		$user = MessagingUser::find()->where(['id'=>$id])->One();
		if($user){
			return $this->render('index', [
                'user' => $user,
            ]);
		}
	}

	public function actionShowthread() {

		return $this->render('message_thread', [
				'msg_id' => $_GET['msg_id']
			]);
		
	}

	public function actionGetthread(){
		$msg_id = $_GET['msg_id'];
		$thread = array();
		while($msg_id){
			$msg = MessagingMessage::find()->where(['id'=>$msg_id])->One();
			if($msg){
				$m = array();
				$m['id'] = $msg->id;
				$m['from'] = $msg->creator->first_name . " " . $msg->creator->last_name;
				$toUsers = MessagingMessageRecipient::find()->where(['message_id' => $msg_id])->One();
				if($toUsers->recipient_group_id)
					$m['to'] = $toUsers->recipientGroup->name;
				else
					$m['to'] = $toUsers->recipient->first_name . " " . $toUsers->recipient->last_name;
				$m['subject'] = $msg->subject;
				$m['create_date'] = $msg->create_date;
				$m['body'] = $msg->message_body;
				$thread[] = $m;
				$msg_id = $msg->parent_message_id;
				//print_r($thread);
				//echo "<br>";

			}
			
		}
		$thread = array_reverse($thread);
		echo json_encode($thread);
	}

	public function actionInbox(){

		$id = $_GET['id'];
		$groups = (new Query())->select('group_id')->from('messaging_user_group')->where(['user_id' => $id]);
		$messages = MessagingMessageRecipient::find()
		->where(['recipient_id' =>  $id])
		->orWhere(['recipient_group_id' =>  $groups])
		->all();
		
		$inbox = array();
		foreach ($messages as $message) {
			$m = array();
			$m['recipient_group_id'] = $message->recipient_group_id;
			$m['is_read'] = $message->is_read;
			$m['msg_id'] = $message->message->id;
			$m['subject'] = $message->message->subject;
			$m['sender'] = $message->message->creator->first_name . " " . $message->message->creator->last_name;
			$m['body'] = $message->message->message_body;
			$m['create_date'] = $message->message->create_date;			
			$inbox[] = $m;
		}
		
		echo json_encode($inbox);

	}

}