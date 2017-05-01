angular.module('AdminService', [])
    .factory('AdminService', function (BaseService) {

        var AdminService = {

        };
        return angular.extend(BaseService, AdminService);
    })
;