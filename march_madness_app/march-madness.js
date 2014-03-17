angular.module('marchMadness', ['ngRoute'])

.value('allTeams',
	{
		regions: [
			{
				location: 'South',
				teams: [
					{
						name: 'Flordia',
						seed: 1,
						disableFlag: false
					},
					{
						name: 'Albany/MSM',
						seed: 16,
						disableFlag: false
					},
					{
						name: 'Colorodo',
						seed: 8,
						disableFlag: false
					},
					{
						name: 'Pittsburgh',
						seed: 9,
						disableFlag: false
					},
					{
						name: 'VCU',
						seed: 5,
						disableFlag: false
					},
					{
						name: 'Steph. F. Austin',
						seed: 12,
						disableFlag: false
					},
					{
						name: 'UCLA',
						seed: 4,
						disableFlag: false
					},
					{
						name: 'Tulsa',
						seed: 13,
						disableFlag: false
					},
					{
						name: 'Ohio State',
						seed: 6,
						disableFlag: false
					},
					{
						name: 'Dayton',
						seed: 11,
						disableFlag: false
					},
					{
						name: 'Syracuse',
						seed: 3,
						disableFlag: false
					},
					{
						name: 'Western Mich.',
						seed: 14,
						disableFlag: false
					},
					{
						name: 'New Mexico',
						seed: 7,
						disableFlag: false
					},
					{
						name: 'Stanford',
						seed: 10,
						disableFlag: false
					},
					{
						name: 'Kansas',
						seed: 2,
						disableFlag: false
					},
					{
						name: 'Eastern Kentucky',
						seed: 15,
						disableFlag: false
					}
				]
			},
			{
				location: 'West',
				teams: [
					{
						name: 'Arizona',
						seed: 1,
						disableFlag: false
					},
					{
						name: 'Weber State',
						seed: 16,
						disableFlag: false
					},
					{
						name: 'Gonzaga',
						seed: 8,
						disableFlag: false
					},
					{
						name: 'Oklahoma State',
						seed: 9,
						disableFlag: false
					},
					{
						name: 'Oklahoma',
						seed: 5,
						disableFlag: false
					},
					{
						name: 'North Dakota St.',
						seed: 12,
						disableFlag: false
					},
					{
						name: 'San Diego State',
						seed: 4,
						disableFlag: false
					},
					{
						name: 'New Mexico St.',
						seed: 13,
						disableFlag: false
					},
					{
						name: 'Baylor',
						seed: 6,
						disableFlag: false
					},
					{
						name: 'Nebraska',
						seed: 11,
						disableFlag: false
					},
					{
						name: 'Creighton',
						seed: 3,
						disableFlag: false
					},
					{
						name: 'La.-Lafayette',
						seed: 14,
						disableFlag: false
					},
					{
						name: 'Oregon',
						seed: 7,
						disableFlag: false
					},
					{
						name: 'BYU',
						seed: 10,
						disableFlag: false
					},
					{
						name: 'Wisconsin',
						seed: 2,
						disableFlag: false
					},
					{
						name: 'American',
						seed: 15,
						disableFlag: false
					}
				]
			},
			{
				location: 'East',
				teams: [
					{
						name: 'Virginia',
						seed: 1,
						disableFlag: false
					},
					{
						name: 'Coastal Caro.',
						seed: 16,
						disableFlag: false
					},
					{
						name: 'Memphis',
						seed: 8,
						disableFlag: false
					},
					{
						name: 'Geo. Washington',
						seed: 9,
						disableFlag: false
					},
					{
						name: 'Cincinnati',
						seed: 5,
						disableFlag: false
					},
					{
						name: 'Harvard',
						seed: 12,
						disableFlag: false
					},
					{
						name: 'Michigan State',
						seed: 4,
						disableFlag: false
					},
					{
						name: 'Delaware',
						seed: 13,
						disableFlag: false
					},
					{
						name: 'North Carolina',
						seed: 6,
						disableFlag: false
					},
					{
						name: 'Providence',
						seed: 11,
						disableFlag: false
					},
					{
						name: 'Iowa State',
						seed: 3,
						disableFlag: false
					},
					{
						name: 'N.C. Central',
						seed: 14,
						disableFlag: false
					},
					{
						name: 'Connecticut',
						seed: 7,
						disableFlag: false
					},
					{
						name: 'Saint Joseph\'s',
						seed: 10,
						disableFlag: false
					},
					{
						name: 'Villanova',
						seed: 2,
						disableFlag: false
					},
					{
						name: 'Milwaukee',
						seed: 15,
						disableFlag: false
					}
				]
			},
			{
				location: 'Midwest',
				teams: [
					{
						name: 'Wichita State',
						seed: 1,
						disableFlag: false
					},
					{
						name: 'CP/TSU',
						seed: 16,
						disableFlag: false
					},
					{
						name: 'Kentucky',
						seed: 8,
						disableFlag: false
					},
					{
						name: 'Kansas State',
						seed: 9,
						disableFlag: false
					},
					{
						name: 'Saint Louis',
						seed: 5,
						disableFlag: false
					},
					{
						name: 'NCST/XA',
						seed: 12,
						disableFlag: false
					},
					{
						name: 'Louisville',
						seed: 4,
						disableFlag: false
					},
					{
						name: 'Manhattan',
						seed: 13,
						disableFlag: false
					},
					{
						name: 'Massachusetts',
						seed: 6,
						disableFlag: false
					},
					{
						name: 'IOW/TEN',
						seed: 11,
						disableFlag: false
					},
					{
						name: 'Duke',
						seed: 3,
						disableFlag: false
					},
					{
						name: 'Mercer',
						seed: 14,
						disableFlag: false
					},
					{
						name: 'Texas',
						seed: 7,
						disableFlag: false
					},
					{
						name: 'Arizona State',
						seed: 10,
						disableFlag: false
					},
					{
						name: 'Michigan',
						seed: 2,
						disableFlag: false
					},
					{
						name: 'Wofford',
						seed: 15,
						disableFlag: false
					}
				]
			}
		]
	}
)

.value('userChoices',{
	name: '',
	email: '',
	mainTeams: [],
	finalTeams: [{},{}],
	winningTeam: [{}],
	socialClick: []
})

.value('lastView', ['start'])

.config(function($routeProvider){
	$routeProvider
		.when('/', {
			controller: 'StartCtrl',
			templateUrl: '/wordpress/wp-content/themes/exa/march_madness_app/index.html'
		})
		.when('/teams', {
			controller: 'TeamsCtrl',
			templateUrl: '/wordpress/wp-content/themes/exa/march_madness_app/teams.html'
		})
		.when('/email', {
			controller: 'EmailCtrl',
			templateUrl: '/wordpress/wp-content/themes/exa/march_madness_app/email.html'
		})
		.when('/social', {
			controller: 'SocialCtrl',
			templateUrl: '/wordpress/wp-content/themes/exa/march_madness_app/social.html'
		})
		.otherwise({
			redirectTo: '/wordpress/'
		});
})

.controller('StartCtrl', function($scope){
})

.controller('TeamsCtrl', function($scope, allTeams, userChoices, lastView, $location){
	$scope.message = 'This is the Team view';
	$scope.allTeams = allTeams;
	$scope.userChoices = userChoices;
	$scope.choiceMax = 16;
	$scope.choiceListFull = false;
	$scope.lastView = lastView;
	if(userChoices.mainTeams.length == 0){
		for(var i = 0; i < $scope.choiceMax; i++){
			userChoices.mainTeams.push({});
		}
		$scope.choiceIdx = 0;
	}
	else{
		$scope.choiceIdx = 16;
	}

	$scope.addChoice = function(teamName, regionIdxVal, teamIdxVal, teamSeed){
		userChoices.mainTeams[$scope.choiceIdx] = {name: teamName, regionIdx: regionIdxVal, teamIdx: teamIdxVal, seed: ''+teamSeed+''};
		$scope.allTeams.regions[regionIdxVal].teams[teamIdxVal].disableFlag = true;
		$scope.choiceIdx++;
	};

	$scope.removeChoice = function(idx){
		var removed = userChoices.mainTeams.splice(idx, 1);
		userChoices.mainTeams.push({});
		$scope.allTeams.regions[removed[0].regionIdx].teams[removed[0].teamIdx].disableFlag = false;
		$scope.choiceIdx--;
	};

	$scope.nextPage = function(event){
		if(event){
			event.preventDefault();
		}
		lastView[0] = 'teams';
		$location.path('/email');
	};

	$scope.$watch('choiceIdx', function(newvalue, oldvalue){
		if(newvalue === $scope.choiceMax){
			disableAll($scope.allTeams.regions);
			$scope.choiceListFull = true;
		} else if(oldvalue === $scope.choiceMax){
			enableAll($scope.allTeams.regions);
			angular.forEach(userChoices.mainTeams, function(val, key){
				if(val.hasOwnProperty('name')){
					$scope.allTeams.regions[val.regionIdx].teams[val.teamIdx].disableFlag = true;
				}
			});
			$scope.choiceListFull = false;
		}
	});

	var disableAll = function(teamList){
		angular.forEach(teamList, function(val1, key1){
			angular.forEach(val1.teams, function(val2, key2){
				val2.disableFlag = true;
			});
		});
	};
	var enableAll = function(teamList){
		angular.forEach(teamList, function(val1, key1){
			angular.forEach(val1.teams, function(val2, key2){
				val2.disableFlag = false;
			});
		});
	};
})

.controller('EmailCtrl', function($scope, userChoices, lastView, $location){
	$scope.userChoices = userChoices;
	$scope.mainTeamsDisabled = [];
	$scope.lastView = lastView;
	if(lastView == 'teams'){
		userChoices.finalTeams = [{},{}];
		userChoices.winningTeam = [{}];
		$scope.finalsListFull = false;
		$scope.choiceMainIdx = 0;
		for(var i = 0; i < 16; i++){
			$scope.mainTeamsDisabled[i] = false;
		}
	}
	else if(lastView == 'social'){
		$scope.choiceMainIdx = 2;
		$scope.finalsListFull = true;
		for(var i = 0; i < 16; i++){
			$scope.mainTeamsDisabled[i] = true;
		}
	}
	$scope.addFinals = function(teamIdx){
		userChoices.finalTeams[$scope.choiceMainIdx] = userChoices.mainTeams[teamIdx];
		userChoices.finalTeams[$scope.choiceMainIdx].mainListIdx = teamIdx;
		$scope.mainTeamsDisabled[teamIdx] = true;
		$scope.choiceMainIdx++;
	}
	$scope.removeFinals = function(teamIdx){
		var removed = userChoices.finalTeams.splice(teamIdx, 1);
		userChoices.finalTeams.push({});
		userChoices.winningTeam[0] = {};
		$scope.mainTeamsDisabled[removed[0].mainListIdx] = false;
		$scope.choiceMainIdx--;
	}
	$scope.addWinner = function(teamIdx){
		userChoices.winningTeam[0] = userChoices.finalTeams[teamIdx];
	}
	$scope.$watch('choiceMainIdx', function(newvalue, oldvalue){
		if(newvalue === 2){
			for(var i = 0; i < 16; i++){
				$scope.mainTeamsDisabled[i] = true;
			}
			$scope.finalsListFull = true;
		} else if(oldvalue === 2){
			for(var i = 0; i < 16; i++){
				$scope.mainTeamsDisabled[i] = false;
			}
			$scope.mainTeamsDisabled[userChoices.finalTeams[0].mainListIdx] = true;
			$scope.finalsListFull = false;
		}
	});
	$scope.toTeams = function(event){
		if(event){
			event.preventDefault();
		}
		lastView[0] = 'email';
		$location.path('/teams');
	};
	$scope.toSocial = function(event){
		if(event){
			event.preventDefault();
		}
		lastView[0] = 'email';
		$location.path('/social');
	}
})

.controller('SocialCtrl', function($scope, userChoices, lastView, $http, $location){
	$scope.validSocial = false;
	$scope.userChoices = userChoices;
	$scope.socialClick = function(click){
		userChoices.socialClick.push(click);
		$scope.validSocial = true;
	}
	$scope.toEmail = function(event){
		if(event){
			event.preventDefault();
		}
		lastView[0] = 'social';
		$location.path('/email');
	}
	$scope.submit = function(event){
		if(event){
			event.preventDefault();
		}

		$http({
			url: "http://badgerherald.com/march-madness/",
			method: "POST",
			data: {"userChoices": userChoices}
		}).success(function(data, status, headers, config) {
			console.log("Success!");
			console.log(data);
			console.log(status);
		}).error(function(data, status, headers, config) {
			console.error("WAT!");
			console.log(data);
			console.log(status);
		});
		$scope.validSocial = true;
	}
})

.directive('hrldWiscValidate', function(){
	return {
		require: 'ngModel',
		link: function(scope, elem, attr, ctrl){
			var regex = new RegExp('.*?(wisc\\.edu)', '');

			ctrl.$parsers.unshift(function(value){
				var valid = regex.test(value);
				ctrl.$setValidity('hrldWiscValidate', valid);
				return valid ? value : undefined;
			});

			ctrl.$formatters.unshift(function(value){
				ctrl.$setValidity('hrldWiscValidate', regex.test(value));
				return value;
			});
		}
	}
});

/*global angular */
(function (ng) {
	'use strict';

	var app = ng.module('ngLoadScript', []);

	app.directive('script', function() {
		return {
			restrict: 'E',
			scope: false,
			link: function(scope, elem, attr) {
				if (attr.type === 'text/javascript-lazy') {
					var f = new Function(code);
					f();
				}
			}
		};
	});

}(angular));
