angular.module('UserService', [])
    .factory('UserService', function ($http, BaseService) {

        var UserService = {
            getBankAccountInfo: function () {
                return $http({
                    method: 'POST',
                    url: '/get-bank-account-info',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            },

            createPayTransaction: function (data) {
                var params = { params: data };
                return $http({
                    method: 'POST',
                    url: '/create-pay-transaction',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            },

            createTransferTransaction: function (data) {
                var params = { params: data };
                return $http({
                    method: 'POST',
                    url: '/create-transfer-transaction',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            },

            getHistoryTransaction: function () {
                return $http({
                    method: 'POST',
                    url: '/get-history-transaction',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            }
        };
        return angular.extend(BaseService, UserService);
    })
;