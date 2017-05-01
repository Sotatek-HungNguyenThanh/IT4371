angular.module('StaffService', [])
    .factory('StaffService', function ($http, BaseService) {

        var StaffService = {

        };
        return angular.extend(BaseService, StaffService);
    })
;