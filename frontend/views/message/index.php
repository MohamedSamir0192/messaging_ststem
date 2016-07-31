<form action="" method="post" ng-app="">

<input type="hidden" name="Message[creator_id]" value="<?= $user->id ?>" /> <bt><br>
<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

<p> Enter recipient id </p>
<input type="text" name="recipient_id" ng-model="recipient_id" ng-init="recipient_id=''" /> <br><br>
<div ng-if="recipient_id.indexOf(',') !== -1">
<p> Enter group name </p>
<input type="text" name="group_name" >
<br><br>
</div>
<p> Subject: </p>
<input type="text" name="Message[subject]" /> <br><br>
<p> Message Body </p>
<textarea name="Message[message_body]"></textarea> <br><br>
<input type="submit" value="Send">
</form>