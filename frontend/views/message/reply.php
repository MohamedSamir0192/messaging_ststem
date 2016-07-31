<form action="" method="post" >
<input type="hidden" name="Message[creator_id]" value="<?= $user_id ?>" />
<input type="hidden" name="Message[subject]" value="<?= $parent_msg->message->subject ?>" />
<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
<p> Message Body </p>
<textarea name="Message[message_body]"></textarea> <br><br>
<input type="submit" value="Send">
</form>