<div class="container" ng-app="myApp" ng-controller="myCtrl">
	
	<div class="row container panel panel-default" ng-repeat="message in messages">

		<div class="row">
			<div class="col-md-4"><p>From</p></div>
			<div class="col-md-8"><p>{{message.from}}</p></div>
		</div>


		<div class="row">
			<div class="col-md-4"><p>To</p></div>
			<div class="col-md-8"><p>{{message.to}}</p></div>
		</div>

		<div class="row">
			<div class="col-md-4"><p>Date</p></div>
			<div class="col-md-8"><p>{{message.date}}</p></div>
		</div>

		<div class="row">
			<div class="col-md-4"><p>Subject</p></div>
			<div class="col-md-8"><p>{{message.subject}}</p></div>
		</div>

		<div class="row">
			<div class="col-md-4"><p>Message body</p></div>
			<div class="col-md-8"><textarea>{{message.body}}</textarea></div>
		</div>

	</div>

</div>

<script>
var app = angular.module("myApp", []);
app.controller("myCtrl", function($scope , $http) {
    $scope.messages = [];
    $http.get("http://127.0.0.1/messaging_system/frontend/web/index.php?r=message/getthread&msg_id=<?= $_GET['msg_id'] ?>").
    success(function(data, status, headers, config) {
      for(var i=0;i<data.length;i++)
          $scope.messages.push({
                "from" : data[i].from,
                "to" : data[i].to,
                "date" : data[i].create_date,
                "subject" : data[i].subject,
                "body" : data[i].body
          });
    }).
    error(function(data, status, headers, config) {
      // log error
    });
});
</script>