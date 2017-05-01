angular.module('StaffService', [])
    .factory('StaffService', function ($http, BaseService) {

        var StaffService = {
            depositMoneyAccount: function (data) {
                var params = { params: data };
                return $http({
                    method: 'POST',
                    url: '/staff/deposit-money-account',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            }
        };
        return angular.extend(BaseService, StaffService);
    })
;