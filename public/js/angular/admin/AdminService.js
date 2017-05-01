angular.module('AdminService', [])
    .factory('AdminService', function ($http, BaseService) {

        var AdminService = {

        };
        return angular.extend(BaseService, AdminService);
    })
;