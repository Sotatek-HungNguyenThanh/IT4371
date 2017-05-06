<ul class="x-navigation x-navigation-horizontal x-navigation-panel" ng-controller="NotificationController as controller" ng-cloak>
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <li class="xn-icon-button pull-right">
        <a href="#" class="mb-control" data-box="#mb-signout" id="icon-signout"><span class="fa fa-sign-out"></span></a>
    </li>
    <li class="">
        <div class="text-info-account">
            <span> Số dư: @{{ controller.bankAccount.balance | number }}</span>
        </div>
    </li>
    <li class="">
        <div class="text-info-account">
            <span>Số tài khoản: @{{ controller.bankAccount.account_number }}</span>
        </div>
    </li>
</ul>
<style>
    .text-info-account{
        font-size: 20px;
        color: white;
        padding-top: 12px;
        margin-right: 22px;
        position: relative;
    }
    @media screen and (min-width: 980px) {
        #icon-signout{
            position: relative;
            right: 223px;
        }
    }
    @media only screen and (max-width: 1024px) {
        .x-navigation.x-navigation-panel li.xn-icon-text{
            width: auto;
        }
        .text-info-account{
            font-size: 11.2px;
            padding-top: 20px;
            margin-right: 6px;
            right: 0px;
            top: 7px;
            display: inline;
        }
    }
</style>