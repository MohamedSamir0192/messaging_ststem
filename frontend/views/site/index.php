<?php

/* @var $this yii\web\View */
use yii\web\Session;
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div class="container" ng-app="myApp" ng-controller="myCtrl">

    <div class="col-md-6 panel panel-default">
        <div class="row">
            
            <div class="col-md-3">
                Sender
            </div>

            <div class="col-md-3">
                Subject
            </div>

            <div class="col-md-2">
                create date
            </div>
            <div class="col-md-4">
                Actions
            </div>

        </div>
        <div class="row" ng-repeat="message in messages">
            <div class="col-md-3">
                {{message.sender}}
            </div>

            <div class="col-md-3">
                {{message.subject}}
            </div>

            <div class="col-md-2">
                {{message.create_date}}
            </div>
            <div class="col-md-4">
                <a class="btn btn-success" href="<?php echo Url::base() ?>/index.php?r=message/reply&msg_id={{message.msg_id}}">Reply</a>
                <a class="btn btn-success" href="<?php echo Url::base() ?>/index.php?r=message/showthread&msg_id={{message.msg_id}}">Open</a>
            </div>
        </div>        
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5 panel panel-default" >
        
        <center>Message</center>

    </div>

</div>

<script>
var app = angular.module("myApp", []);
app.controller("myCtrl", function($scope , $http) {
    $scope.messages = [];
    $http.get("http://127.0.0.1/messaging_system/frontend/web/index.php?r=message/inbox&id=<?= Yii::$app->params['user_id']; ?>").
    success(function(data, status, headers, config) {
      for(var i=0;i<data.length;i++)
          $scope.messages.push({
                "sender" : data[i].sender,
                "subject" : data[i].subject,
                "create_date" : data[i].create_date,
                "is_read" : data[i].is_read,
                "msg_id" : data[i].msg_id,
          });
    }).
    error(function(data, status, headers, config) {
      // log error
    });
    /*$scope.messages = [
        {
            "sender" : "Mohamed Samir",
            "subject" : "subject",
            "create_date" : "create_date"
        },{
            "sender" : "Ahmed Samir",
            "subject" : "subject",
            "create_date" : "create_date"
        }
    ]*/
});
</script>