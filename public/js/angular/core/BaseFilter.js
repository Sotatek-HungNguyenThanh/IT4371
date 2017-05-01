angular.module('BaseFilter', [])
    .filter('transaction_date', function() {
        return function(date) {
            if(!date) {
                return '';
            }
            return Date.parse(moment(date));
        };
    })
    .filter('type_transaction', function() {
        return function(type) {
            switch (type){
                case "deposit":
                    return "Gửi tiền";
                case "withdraw":
                    return "Rút tiền";
                case "transfer":
                    return "Chuyển khoản";
            }
        };
    })

;
