@extends('user.layout')


@section('title')
    Transfer
@endsection

@section('css')

@endsection
@section('script')
    <script type="text/javascript" src="/js/angular/user/TransferController.js"></script>
@endsection

@section('page_content')
    <div class="row" ng-controller="TransferController as controller">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="container-content">
                    <form name="formPay">
                        {{ csrf_field() }}
                        <div class="container-header">
                            Chuyển khoản
                        </div>
                        <div class="container-body">
                            <div class="row">
                                <h3>Thông tin tài khoản</h3>
                                <div class="col-md-9">
                                    <span>Tài khoản nguồn:</span>
                                    <input type="text" name="bank_account" class="form-control"
                                           placeholder="Tài khoản nguồn" disabled ng-model="controller.bankAccount.account_number">
                                    <span>Số dư tài khoản:</span>
                                    <input type="text" name="balance" id="balance" class="form-control"
                                           placeholder="Số dư tài khoản" disabled ng-model="controller.bankAccount.balance" input-number>
                                </div>
                            </div>
                            <div class="row">
                                <h3>Thông tin chuyển khoản</h3>
                                <div class="col-md-9">
                                    <span>Người nhận:</span>
                                    <input type="text" name="receiver_name" class="form-control"
                                           placeholder="Người nhận" required ng-model="controller.receiver_name">
                                    <span>Số tài khoản:</span>
                                    <input type="text" name="account_number" class="form-control"
                                           placeholder="Số tài khoản" required ng-model="controller.account_number">
                                    <span>Số tiền:</span>
                                    <input type="text" name="amount" number id="amount" class="form-control" title="field is number"
                                           placeholder="Số tiền" required ng-model="controller.amount">
                                    <span>Ngày chuyển khoản:</span>
                                    <input type="text" name="date"  class="form-control" placeholder="Ngày chuyển khoản" ng-model="controller.currentDate" disabled>
                                    <span>Nội dung:</span>
                                    <textarea name="content" rows="4" class="form-control" ng-model="controller.content" placeholder="Nội dung" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary"
                                                ng-click="controller.createTransferTransaction()">Chuyển khoản</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            window.onload = function () {
                document.getElementById("balance").onchange = validateBalance;
                document.getElementById("amount").onchange = validateBalance;
            };
            function validateBalance(){
                var balance = parseFloat(document.getElementById("balance").value.replace(/,/g, ""));
                var amount = parseFloat(document.getElementById("amount").value.replace(/,/g, ""));
                if(amount > balance)
                    document.getElementById("amount").setCustomValidity("Số tiền lớn hơn số dư trong tài khoản");
                else
                    document.getElementById("amount").setCustomValidity('');
            }
            function validateNumber() {
                var number = document.getElementById("amount").value.replace(/,/g, "");
                if(!/^([0-9])+$/.test(number)){
                    document.getElementById("amount").setCustomValidity("Invalid Number");
                }else {
                    document.getElementById("amount").setCustomValidity("");
                }
            }
        </script>
    </div>
@endsection