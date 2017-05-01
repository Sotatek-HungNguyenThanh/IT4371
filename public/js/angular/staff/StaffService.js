angular.module('StaffService', [])
    .factory('StaffService', function (BaseService) {

        var StaffService = {

        };
        return angular.extend(BaseService, StaffService);
    })
;