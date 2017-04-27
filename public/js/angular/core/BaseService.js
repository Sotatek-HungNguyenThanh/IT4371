angular.module('BaseService', [])

    .factory('BaseService', function ($http) {

        return {
            getListArbitration : function () {
                return $http({
                    method: 'POST',
                    url: '/arbitration/get-list-arbitration',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            },

            getListClub : function () {
                return $http({
                    method: 'POST',
                    url: '/club/get-list-club',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            },

            updateClub : function (params) {
                return $http({
                    method: 'POST',
                    url: '/club/update-club',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            },

            removeClub: function (id) {
                var data = {
                    'id': id
                };
                return $http({
                    method: 'POST',
                    url: '/club/remove-club',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                });
            },

            updateArbitration : function (params) {
                return $http({
                    method: 'POST',
                    url: '/arbitration/update-arbitration',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            },

            removeArbitration: function (id) {
                var data = {
                    'id': id
                };
                return $http({
                    method: 'POST',
                    url: '/arbitration/remove-arbitration',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                });
            },

            updateSponsor : function (params) {
                return $http({
                    method: 'POST',
                    url: '/sponsor/update-sponsor',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            },

            removeSponsor: function (id) {
                var data = {
                    'id': id
                };
                return $http({
                    method: 'POST',
                    url: '/sponsor/remove-sponsor',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                });
            },

            getListSponsor : function () {
                return $http({
                    method: 'POST',
                    url: '/sponsor/get-list-sponsor',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            },

            getAccountInfo : function () {
                return $http({
                    method: 'POST',
                    url: '/account/get-account-info',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            },

            getListRegulation : function () {
                return $http({
                    method: 'POST',
                    url: '/regulation/get-list-regulation',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            },

            updateRegulation : function (params) {
                return $http({
                    method: 'POST',
                    url: '/regulation/update-regulation',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            },

            removeRegulation: function (id) {
                var data = {
                    'id': id
                };
                return $http({
                    method: 'POST',
                    url: '/regulation/remove-regulation',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                });
            },


            getListMatch : function () {
                return $http({
                    method: 'POST',
                    url: '/schedule/get-list-schedule',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            },

            updateMatch : function (params) {
                return $http({
                    method: 'POST',
                    url: '/schedule/update-schedule',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            },

            removeMatch: function (id) {
                var data = {
                    'id': id
                };
                return $http({
                    method: 'POST',
                    url: '/schedule/remove-schedule',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                });
            },


            getListRank : function () {
                return $http({
                    method: 'POST',
                    url: '/rank/get-list-rank',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                });
            },

            updateRank : function (params) {
                return $http({
                    method: 'POST',
                    url: '/rank/update-rank',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(params)
                });
            },

            removeRank: function (id) {
                var data = {
                    'id': id
                };
                return $http({
                    method: 'POST',
                    url: '/rank/remove-rank',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                });
            },

        }
    });