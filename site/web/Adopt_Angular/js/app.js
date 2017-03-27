angular.module('myApp', [
  'ngRoute',
  'animalCtrl'
])
.config(function ($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true);
  $routeProvider.
   when('/list', {
    templateUrl: '../../../Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  }).
  when('/list/:petId', {
    templateUrl: '../../../Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  }).
  when('/list/:type/:gender/:size/:age/:color/:pagenum/:location/:qsort', {
    templateUrl: '../../../Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  }).
  when('/list/:type/:gender/:size/:age/:color/:pagenum/:location', {
    templateUrl: '../../../Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  }).
  when('/details/:itemId', {
    templateUrl: '../../../Adopt_Angular/partials/details.html',
    controller: 'DetailCtrl'
  }).
  otherwise({
    redirectTo: '/',
    templateUrl: '../../../Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  });
  // enable html5Mode for pushstate ('#'-less URLs)
});