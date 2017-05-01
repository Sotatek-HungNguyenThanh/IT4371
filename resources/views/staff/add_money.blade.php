@extends('staff.layout')


@section('title')
    Add money
@endsection
@section('script')
    <script type="text/javascript" src="/js/angular/staff/DepositMoneyController.js"></script>
@endsection
@section('page_content')
    <div class="row" ng-controller ="DepositMoneyController as controller">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="container-content">
                    <form name="formDeposit">
                        {{ csrf_field() }}
                        <div class="container-header">
                            Thêm tiền vào tài khoản
                        </div>
                        <div class="container-body">
                                <div class="alert alert-success" ng-show="controller.status == 'success'">
                                    <strong>Success!</strong> thêm tiền vào tài khoản thành công!
                                </div>
                                <div class="alert alert-danger" ng-show="controller.status == 'error'">
                                    <ul>
                                        <li>Số tài khoản không đúng</li>
                                    </ul>
                                </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <span>Người gửi:</span>
                                    <input type="text" name="sender_name" class="form-control" placeholder="Name" required ng-model="controller.sender_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <span>Số tài khoản:</span>
                                    <input type="text"  class="form-control" name="account_number"
                                           placeholder="Số tài khoản" required ng-model="controller.account_number">
                                    <span>Số tiền:</span>
                                    <input type="text" name="amount" number id="amount" class="form-control" title="field is number"
                                           placeholder="Số tiền" required ng-model="controller.amount">
                                    <span>Ngày gửi tiền:</span>
                                    <input type="text" name="date"  class="form-control" placeholder="Ngày thanh toán" ng-model="controller.currentDate" disabled>
                                    <span>Nội dung:</span>
                                    <textarea name="content" rows="4" class="form-control" ng-model="controller.content" placeholder="Nội dung" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary" ng-click="controller.depositMoneyAccount()">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection