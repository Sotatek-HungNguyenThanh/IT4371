angular.module('BaseFilter', [])
    .filter('transaction_date', function() {
        return function(date) {
            if(!date) {
                return '';
            }
            return Date.parse(moment(date));
        };
    })

;
