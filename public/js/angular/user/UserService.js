angular.module('UserService', [])
    .factory('UserService', function (BaseService) {

        var UserService = {

        };
        return angular.extend(BaseService, UserService);
    })
;