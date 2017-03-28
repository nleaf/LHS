var animalCtrl = angular.module('animalCtrl', ['angulike', 'youtube-embed', 'ngDialog', 'viewhead', 'ngTouch', 'ngSanitize'])
.run(['$route', function($route)  {
  $route.reload();
}])
.run([ '$rootScope', function ($rootScope) {
          $rootScope.facebookAppId = '[1441533632843897]'; // set your facebook app id here
}])
.service('sharedProperties', function() {
    var stringValue = 'test string value';
    var objectValue = {
        data: 'test object value'
    };
    
    return {
        getString: function() {
            return stringValue;
        },
        setString: function(value) {
            stringValue = value;
        },
        getObject: function() {
            return objectValue;
        }
    }
})
.filter('inSlicesOf', 
		['$rootScope',  
		function($rootScope) {
			makeSlices = function(items, count) { 
				if (!count)            
					count = 4;
				
				if (!angular.isArray(items) && !angular.isString(items)) return items;
				
				var array = [];
				for (var i = 0; i < items.length; i++) {
					var chunkIndex = parseInt(i / count, 10);
					var isFirst = (i % count === 0);
					if (isFirst)
						array[chunkIndex] = [];
					array[chunkIndex].push(items[i]);
				}

				if (angular.equals($rootScope.arrayinSliceOf, array))
					return $rootScope.arrayinSliceOf;
				else
					$rootScope.arrayinSliceOf = array;
					
				return array;
			};
			
			return makeSlices; 
		}])
.directive('imageonload', function() {
    return {
      restrict: 'A',
      link: function(scope, element, attrs) {
        element.bind('load', function() {
          element.parent().parent().addClass('in');
          //console.log(element.parent('div'));
          //call the function that was passed
          //scope.$apply(attrs.imageonload);
        }).bind('error', function() {
          //
        });

        scope.$watch('ngSrc', function(newVal) {
          //element.removeClass('in');
        });
      }
    };
});
animalCtrl.filter('escape', function() {
  return window.escape;
});
animalCtrl.service('animalService', function() {

  this.aData = {aId: 0};

  this.animal = function() {
        return this.aData;
  };

  this.setLocation = function(alocation) {
  		//console.log('logged:' + alocation);
        this.aData.alocation = alocation;
  };

  this.getLocation = function() {
        return this.aData.alocation;
  };
});
animalCtrl.controller('ListCtrlCustom', ['$scope', '$http', '$routeParams', '$location', '$timeout', 'animalService', '$window', 'sharedProperties',  function($scope, $http, $routeParams, $location, $timeout, animalService, $window, sharedProperties) {
	//console.log($location.path());
	
		//sorting
	$scope.stringValue = sharedProperties.getString();
    $scope.objectValue = sharedProperties.getObject().data; 
	
    $scope.setString = function(newValue) {
        $scope.objectValue.data = newValue;
        sharedProperties.setString(newValue);
    };
	
	$scope.$on('$viewContentLoaded', function(event) {
		$window.ga('send', 'pageview', { page: 'services/adoption/adopt'+$location.path(), title: ' Adoption Search | Animal Foundation' });
		//console.log('gaq:' + $location.path());
	 });

	$scope.idefault = '';
	$scope.checkvalue = function(idefault) {
		if($scope.idefault==''){
			$scope.idefault = 'A';
		}else{
			return;	
		}
	}
	$scope.replacevalue = function(idefault) {
		if($scope.idefault=='A'){
			$scope.idefault = '';
		}else{
			return;	
		}
	}
	
	//Define drop-down paramaters
	$scope.aTypes = [
      {name:'Dog', value:'type_Dog'},
      {name:'Cat', value:'type_Cat'},
      {name:'Other', value:'type_OO'}
    ];

    $scope.aGenders = [
      {name:'Male', value:'gender_m'},
      {name:'Female', value:'gender_f'},
      {name:'Any', value:'gender_0'}
    ];

    $scope.aAges = [
      {name:'Under 1 year', value:'age_y'},
      {name:'1 year and older', value:'age_o'},
      {name:'Any', value:'age_0'}
    ];

    $scope.aSizes = [
      {name:'Small', value:'size_s'},
      {name:'Medium', value:'size_m'},
      {name:'Large', value:'size_l'},
      {name:'Any', value:'size_0'}
    ];

    $scope.aColors = [
      {name:'Black', value:'color_b'},
      {name:'Brown', value:'color_br'},
      {name:'White', value:'color_w'},
      {name:'Other', value:'color_oo'},
      {name:'Any', value:'color_0'}
    ];

    $scope.aLocations = [
      {name:'All', value:'lsvg_new'},
      {name:'Campus Adoption Center (Las Vegas)', value:'lsvg_campus'},
      {name:'PetSmart Charities Everyday Adoption Center (Henderson)', value:'lsvg_psh'},
      {name:'Offsite', value:'lsvg_offsite'}
    ];

    //timeout for page refresh prepopulated drop-downs on list-details
    $scope.selectedaType = $scope.aTypes[0];
    $scope.selectedaGender = $scope.aGenders[2];
    $scope.selectedaAge = $scope.aAges[2];
    $scope.selectedaColor = $scope.aColors[4];
    $scope.selectedaSize = $scope.aSizes[3];
    $scope.selectedaLocation = $scope.aLocations[0];

	$timeout(function () {
	    //Grab current URL path and parse
	    var pageA = $location.path().split('/');

	    //selection for Type drop down
	    for (var i = 0; i < $scope.aTypes.length; i++) {
	        if ($scope.aTypes[i].value === pageA[2]) {
	            $scope.selectedaType = $scope.aTypes[i];
	        }
	    }
	    //selection for Gender drop down	
	    for (var i = 0; i < $scope.aGenders.length; i++) {
	        if ($scope.aGenders[i].value === pageA[3]) {
	            $scope.selectedaGender = $scope.aGenders[i];
	        }
	    }

	    //selection for Age drop down	
	    for (var i = 0; i < $scope.aAges.length; i++) {
	        if ($scope.aAges[i].value === pageA[5]) {
	            $scope.selectedaAge = $scope.aAges[i];
	        }
	    }

	    //selection for Color drop down	
	    for (var i = 0; i < $scope.aColors.length; i++) {
	        if ($scope.aColors[i].value === pageA[6]) {
	            $scope.selectedaColor = $scope.aColors[i];
	        }
	    }

	    //selection for Size drop down	
	    for (var i = 0; i < $scope.aSizes.length; i++) {
	        if ($scope.aSizes[i].value === pageA[4]) {
	            $scope.selectedaSize = $scope.aSizes[i];
	        }
	    }
	    
	    //selection for Location drop down	
	    for (var i = 0; i < $scope.aLocations.length; i++) {
	        if ($scope.aLocations[i].value === pageA[8]) {
	            $scope.selectedaLocation = $scope.aLocations[i];
	            return;
	        }
	    }
	});

	//define Animal ID Input feild in the scope
    $scope.aInputId = $routeParams.petId;

	var aType = $routeParams.type;
	var aGender = $routeParams.gender;
	var aSize = $routeParams.size;
	var aAge = $routeParams.age;
	var aColor = $routeParams.color;
	var aPage = $routeParams.pagenum;
	var aLocation = $routeParams.location;
	var aSort = $routeParams.qsort;

	var urib = 'http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_'+aLocation+'&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=' + aType + ',' + aGender + ',' + aSize + ',' + aAge + ',' + aColor;
	var enUrl = encodeURIComponent(urib);
	var uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php?l=' + enUrl;

	if(aSort) {
		//console.log('aSort');
	  urib = 'http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_'+aLocation+'&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=' + aType + ',' + aGender + ',' + aSize + ',' + aAge + ',' + aColor + '&NewOrderBy=' + aSort;
	    enUrl = encodeURIComponent(urib);
	    uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php?l=' + enUrl + '%26PAGE%3D' + aPage;
	}else if(aLocation) {
	  // aLocation is defined
	  uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php?l=' + enUrl + '%26PAGE%3D' + aPage;
	}else if ($scope.aInputId){
		urib = 'http://www.petharbor.com/results.asp?searchtype=ID&stylesheet=include/default.css&frontdoor=1&friends=1&samaritans=1&nosuccess=0&rows=24&imght=120&imgres=detail&tWidth=200&view=sysadm.v_lsvg_new&fontface=arial&fontsize=10&miles=20&lat=36.194168&lon=-115.22206&shelterlist=%27LAWR%27&atype=&nav=1&start=4&nomax=1&page=1&where=ID_'+$scope.aInputId;
	    enUrl = encodeURIComponent(urib);
	    uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php?l=' + enUrl;
	}else{
		uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php';
	};
	$http.get(uri).success (function(data){
		$scope.pages = data[0];
		$scope.animals = data[1];
		//console.log()
	});

	$scope.changeClass = function(aId) {
        $scope.loaded = aId;
        //console.log('AnimalID' + aId);
    };

    $scope.search = function() {
    	if($scope.idefault) {	
    		var aniId = $scope.idefault;  
			//console.log(aniId);
	    	urib = 'http://www.petharbor.com/results.asp?searchtype=ID&stylesheet=include/default.css&frontdoor=1&friends=1&samaritans=1&nosuccess=0&rows=24&imght=120&imgres=detail&tWidth=200&view=sysadm.v_lsvg_new&fontface=arial&fontsize=10&miles=20&lat=36.194168&lon=-115.22206&shelterlist=%27LAWR%27&atype=&nav=1&start=4&nomax=1&page=1&where=ID_'+aniId;
		    enUrl = encodeURIComponent(urib);
		    uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php?l=' + enUrl;
		    $location.path('/list/'+ aniId, false);
		}else{
			aType = $scope.selectedaType.value;
	    	aGender = $scope.selectedaGender.value;
	    	aAge = $scope.selectedaAge.value;
	    	aSize = $scope.selectedaSize.value;
	    	aColor = $scope.selectedaColor.value;
	    	aLocation = $scope.selectedaLocation.value;
	        urib = 'http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_' + aLocation + '&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=' + aType + ',' + aGender + ',' + aSize + ',' + aAge + ',' + aColor;
		    enUrl = encodeURIComponent(urib);
		    uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php?l=' + enUrl + '%26PAGE%3D';
		    $location.path('/list/'+ aType +'/'+ aGender +'/'+ aSize +'/'+ aAge +'/'+ aColor +'/1/' + aLocation, false);
		    animalService.setLocation(aLocation);
		};

	    $http.get(uri).success (function(data){
			$scope.pages = data[0];
			$scope.animals = data[1]; 
		});

    };
	
	//sorting
    $scope.qSort = function(sortby) {
    	aSort = sortby;
    	if($routeParams.location) {
	  		urib = 'http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_'+aLocation+'&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=' + aType + ',' + aGender + ',' + aSize + ',' + aAge + ',' + aColor + '&NewOrderBy=' + aSort + '&PAGE=1';
		}else{
			//console.log($routeParams);
			//console.log('test2');
			aType = 'type_Dog';
			aGender = 'gender_0';
			aSize = 'size_0';
			aAge = 'age_0';
			aColor = 'color_0';
			aLocation = 'lsvg_new';
			urib = 'http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_lsvg_new&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=type_Dog,gender_0,size_0,age_0,color_0&NewOrderBy='+ aSort + '&PAGE=1';
		};
	    enUrl = encodeURIComponent(urib);
	    uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php?l=' + enUrl;

	    $http.get(uri).success (function(data){
			$scope.pages = data[0];
			$scope.animals = data[1]; 
			$location.path('/list/'+ aType +'/'+ aGender +'/'+ aSize +'/'+ aAge +'/'+ aColor +'/1/' + aLocation +'/' + aSort, false);
		});
    };

    $scope.qPages = function(pagenum) {
    	//console.log(pagenum);

	    if($routeParams.location) {
	  		urib = 'http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_'+aLocation+'&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=' + aType + ',' + aGender + ',' + aSize + ',' + aAge + ',' + aColor + '&NewOrderBy=' + aSort;
		}else{
			aType = 'type_Dog';
			aGender = 'gender_0';
			aSize = 'size_0';
			aAge = 'age_0';
			aColor = 'color_0';
			aLocation = 'lsvg_new';
			urib = 'http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_lsvg_new&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=type_Dog,gender_0,size_0,age_0,color_0'+ '&NewOrderBy=' + aSort;
		};
	    enUrl = encodeURIComponent(urib);
	    uri = 'http://lawrencehumane.dev/ngservice/example/example_adopt.php?l=' + enUrl + '%26PAGE%3D' + pagenum;

	    $http.get(uri).success (function(data){
			$scope.pages = data[0];
			$scope.animals = data[1]; 
		});
		if(aSort){
			$location.path('/list/'+ aType +'/'+ aGender +'/'+ aSize +'/'+ aAge +'/'+ aColor +'/' + pagenum +'/' + aLocation+'/' + aSort, false);
		}else{
			$location.path('/list/'+ aType +'/'+ aGender +'/'+ aSize +'/'+ aAge +'/'+ aColor +'/' + pagenum +'/' + aLocation, false);
		}
	
    };
    animalService.setLocation($scope.selectedaLocation.value);
	//console.log('End: '+$scope.selectedaLocation.value);
}]);

animalCtrl.controller('ListCtrl', ['$scope', '$http', '$routeParams','$location', function($scope, $http, $routeParams, $location) {
  $http.get('http://lawrencehumane.dev/ngservice/example/example_adopt.php').success (function(data){
    $scope.pages = data[0];
    $scope.animals = data[1];
  });
}]);

animalCtrl.controller('DetailCtrl', ['$scope', '$http', '$routeParams', 'animalService', '$timeout', 'ngDialog', '$window', '$location', 'sharedProperties', function($scope, $http, $routeParams, animalService, $timeout, ngDialog, $window, $location, sharedProperties) {
	
/*	$scope.$on('$viewContentLoaded', function(event) {
		$window.ga('send', 'pageview', { page: 'services/adoption/adopt'+$location.path() });
		console.log('gaq:' + $location.path());
	 });*/
	 
	$scope.stringValue = sharedProperties.getString;
    $scope.objectValue = sharedProperties.getObject();
	 
	var whichId = $routeParams.itemId;
	var uri = 'http://www.petharbor.com/detail.asp?ID=' + whichId + '&LOCATION=LAWR&searchtype=ID&start=4&stylesheet=include/default.css&frontdoor=1&friends=1&samaritans=1&nosuccess=0&rows=24&imght=120&imgres=detail&tWidth=200&view=sysadm.v_animal&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=ID_' + whichId;
	var enUrl = encodeURIComponent(uri);

	$http.get('http://lawrencehumane.dev/ngservice/example/example_adopt.php?d='+ enUrl)
		.success(function(data){
			$scope.animals = data;
			$scope.aContent = $scope.animals[0].debug;
			$scope.aKennel = $scope.animals[0].kennelId;

			$scope.theBestVideo = $scope.animals[0].video;
			
			$scope.myModel = {
				Text: "Adopt "+$scope.animals[0].name+" from @animalfndlv today! #AdoptLasVegas", // text for tweet and pinIt buttons
				Name: "Adopt "+$scope.animals[0].name+" from @animalfndlv today! #AdoptLasVegas", // text for tweet and pinIt buttons
				Url: "http://lawrencehumane.dev/services/adoption/adopt/details/"+$scope.animals[0].id,
				Handle: "animalfndlv",
				ImageUrl: $scope.animals[0].image // image url for pinIt button
			};
			
			$window.ga('send', 'pageview', { page: 'services/adoption/adopt'+$location.path(), title: $scope.animals[0].name+' | Animal Foundation' });
			
			$scope.clickToOpen = function () {
				ngDialog.open({ 
					template: '../../Adopt_Angular/partials/popup.html',
					className: 'ngdialog-theme-default',
					scope: $scope
				});
			};
		})
		.error(function(data){
			console.log('unavailable');
			$scope.animals = data;
			//$scope.animal.name = 'Animal Unavailable';
		});
}]);
