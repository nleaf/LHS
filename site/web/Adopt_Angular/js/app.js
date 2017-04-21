angular.module('myApp', [
  'ngRoute',
  'animalCtrl'
])
.config(function ($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true);
  $routeProvider.
   when('/list', {
    templateUrl: 'http://lawrencehumane.org/Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  }).
  when('/list/:petId', {
    templateUrl: 'http://lawrencehumane.org/Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  }).
  when('/list/:type/:gender/:size/:age/:color/:pagenum/:location/:qsort', {
    templateUrl: 'http://lawrencehumane.org/Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  }).
  when('/list/:type/:gender/:size/:age/:color/:pagenum/:location', {
    templateUrl: 'http://lawrencehumane.org/Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  }).
  when('/details/:itemId', {
    templateUrl: 'http://lawrencehumane.org/Adopt_Angular/partials/details.html',
    controller: 'DetailCtrl'
  }).
  otherwise({
    redirectTo: '/',
    templateUrl: 'http://lawrencehumane.org/Adopt_Angular/partials/list.html',
    controller: 'ListCtrlCustom'
  });
  // enable html5Mode for pushstate ('#'-less URLs)
});
