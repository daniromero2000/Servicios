<!DOCTYPE html>
<html ng-app="plunker">

<head>
  <meta charset="utf-8" />
  <title>AngularJS Plunker</title>
  <script>
    document.write('<base href="' + document.location + '" />');
  </script>
  <link rel="stylesheet" href="http://mbenford.github.io/ngTagsInput/css/ng-tags-input.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
  <script src="http://mbenford.github.io/ngTagsInput/js/ng-tags-input.min.js"></script>
</head>

<body ng-controller="MainCtrl">
  <tags-input ng-model="tags"></tags-input>
  <p>Model: @{{tags}}</p>
</body>

<script>
  var app = angular.module('plunker', ['ngTagsInput']);

app.controller('MainCtrl', function($scope, $http) {
  $scope.tags = [
    { text: 'Tag1' },
    { text: 'Tag2' },
    { text: 'Tag3' }
  ];
});
</script>


</html>