@extends('user.layout')
@section('title')
    History
@endsection

@section('css')
    <style>
        table.table > tbody > tr td, table.table > tbody > tr th, table.table > thead > tr td, table.table > thead > tr th {
            font-size: 14px;
            padding: 15px 30px;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
    </style>
@endsection
@section('script')
    <script type="text/javascript" src="/js/angular/user/HistoryController.js"></script>
@endsection
@section('page_content')
    <div class="row" ng-controller="HistoryController as controller">
        <div class="col-md-12">
            <div class="container-content">
                <div class="container-header">
                    Lịch sử giao dịch
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thời gian</th>
                            <th>Loại giao dich</th>
                            <th>Người gửi</th>
                            <th>Người nhận</th>
                            <th>Số tài khoản</th>
                            <th>Số tiền</th>
                            <th>Nội dung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="row in controller.historyTransactions">
                            <td>@{{ $index + 1 }}</td>
                            <td>@{{ row.date | transaction_date | date : 'yyyy/MM/dd' }}</td>
                            <td>@{{ row.type | type_transaction }}</td>
                            <td>@{{ row.name }}</td>
                            <td>@{{ row.receiver_name }}</td>
                            <td>@{{ row.account_number ? row.account_number : row.bank_account_number }}</td>
                            <td>@{{ row.amount | number }}</td>
                            <td>@{{ row.content }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection