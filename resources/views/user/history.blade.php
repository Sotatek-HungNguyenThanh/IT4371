@extends('user.layout')
@section('title')
    History
@endsection

@section('css')
    <style>
        table{
            width: 1065px;
            border-spacing: 1px;
            border: 1px solid #c4c4c4;
            margin-top: 30px;
        }
        table tbody {
            background: #f2f2f2;
            font-size: 12px;
            text-align: center;
            display: block;
            width: 100%;
            overflow-y: auto;
            /*overflow-x: hidden;*/
            max-height: 600px;
            height: 600px;
        }
        table tbody tr:nth-child(odd){
            background: #FFFFFF;
        }
        table tbody tr:nth-child(even){
            background: #f2f2f2;
        }
        tbody tr td {
            border: 1px solid white;
            text-overflow: ellipsis;
            /* white-space: nowrap;*/
            max-height: 40px;
            line-height: 13px;
            height: 40px;
            border: 1px solid #fff;
        }
        thead tr th {
            border: 1px solid white;
        }
        table tbody tr{
            width: 100%;
            height: 40px;
        }
        table thead th {
            height: 40px;
            text-align: center;
            color: white;
            position: relative;
            font-size: 11px;
            background: rgb(57, 144, 171);
            max-height: 40px;
            width: 100%;
        }
        tbody, thead{
            display: inherit;
            width: 100%;
        }

         table thead .column-first {
            width: 2%;
        }

         table thead .column-second {
            width: 7%;
        }

         table thead .column-third {
            width: 7%;
        }

         table thead .column-fourth {
            width: 8%;
        }

         table thead .column-fifth {
            width: 7%;
        }

         table thead .column-sixth {
            width: 17%;
        }

         table thead .column-seventh {
            width: 13%;
        }

         table thead .column-eighth {
            width: 10%;
        }

         table tbody .column-first {
            width: 2%;
            max-width: 2%;
            min-width: 22px;
        }

         table tbody .column-second {
            width: 7%;
            max-width: 7%;
        }

         table tbody .column-third {
            width: 7%;
            max-width: 15px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

         table tbody .column-fourth {
            width: 8%;
            text-align: center;
            padding-right: 5px;
            max-width: 11px;
            position: relative;
        }

         table tbody .column-fifth {
            width: 7%;
            text-align: right;
            padding-right: 5px;
            max-width: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

         table tbody .column-sixth {
            width: 17%;
            /*text-align: right;*/
            padding-right: 5px;
            max-width: 10px;
        }

         table tbody .column-seventh {
            width: 13%;
            max-width: 13%;
             overflow: hidden;
             text-overflow: ellipsis;
             white-space: nowrap
        }

         table tbody .column-eighth {
            width: 10%;
            text-align: center;
            max-width: 10%;
             overflow: hidden;
             text-overflow: ellipsis;
             white-space: nowrap
        }

    </style>
@endsection
@section('script')
    <script type="text/javascript" src="/js/angular/user/HistoryController.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
    <script>
        $(function(){
            $('#bodyHistoryTransactions').slimScroll({
                height: '450px'
            });
        });
    </script>
@endsection
@section('page_content')
    <div class="row" ng-controller="HistoryController as controller">
        <div class="col-md-12">
            <div class="container-content">
                <div class="container-header">
                    Lịch sử giao dịch
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="column-first">#</th>
                            <th class="column-second">Thời gian</th>
                            <th class="column-third">Loại giao dich</th>
                            <th class="column-fourth">Người gửi</th>
                            <th class="column-fifth">Người nhận</th>
                            <th class="column-sixth">Số tài khoản</th>
                            <th class="column-seventh">Số tiền</th>
                            <th class="column-eighth">Nội dung</th>
                        </tr>
                    </thead>
                    <tbody id="bodyHistoryTransactions">
                        <tr ng-repeat="row in controller.historyTransactions">
                            <td class="column-first">@{{ $index + 1 }}</td>
                            <td class="column-second">@{{ row.date | transaction_date | date : 'yyyy/MM/dd' }}</td>
                            <td class="column-third">@{{ row.type | type_transaction }}</td>
                            <td class="column-fourth">@{{ row.sender_id ? row.sender_name? row.sender_name : row.name : row.sender_name  }}</td>
                            <td class="column-fifth">@{{ row.receiver_name }}</td>
                            <td class="column-sixth">@{{ row.account_number ? row.account_number : row.bank_account_number }}</td>
                            <td class="column-seventh">@{{ row.amount | number }}</td>
                            <td class="column-eighth">@{{ row.content }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection