angular.module('UserService', [])
    .factory('UserService', function ($http, BaseService) {

        var UserService = {
            getBankAccountInfo: function () {
                return $http({
                    method: 'POST',
                    url: '/get-bank-account-info',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            }
        };
        return angular.extend(BaseService, UserService);
    })
;