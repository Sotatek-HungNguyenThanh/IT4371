@extends('admin.layout')


@section('title')
    List Staff
@endsection

@section('css')
    <style>
        table{
            width: 100%;
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
            width: 5%;
        }

        table thead .column-second {
            width: 10%;
        }

        table thead .column-third {
            width: 10%;
        }

        table thead .column-fourth {
            width: 8%;
        }

        table thead .column-fifth {
            width: 8%;
        }

        table thead .column-sixth {
            width: 17%;
        }

        table thead .column-seventh {
            width: 13%;
        }

        table tbody .column-first {
            width: 5%;
            max-width: 2%;
            min-width: 53px;
        }

        table tbody .column-second {
            width: 10%;
            max-width: 7%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        table tbody .column-third {
            width: 10%;
            max-width: 15px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        table tbody .column-fourth {
            width: 8%;
            text-align: center;
            padding-right: 5px;
            max-width: 11px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        table tbody .column-fifth {
            width: 8%;
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
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        table tbody .column-seventh {
            width: 13%;
            max-width: 13%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

    </style>
@endsection
@section('script')
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
    <div class="row">
        <div class="col-md-12">
            <div class="container-content">
                <div class="container-header">
                    Danh sách nhân viên
                </div>
                <table>
                    <thead>
                    <tr>
                        <th class="column-first">#</th>
                        <th class="column-second">Tên</th>
                        <th class="column-third">Email</th>
                        <th class="column-fourth">Password</th>
                        <th class="column-fifth">Số điện thoại</th>
                        <th class="column-sixth">Địa chỉ</th>
                        <th class="column-seventh">Status</th>
                    </tr>
                    </thead>
                    <tbody id="bodyHistoryTransactions">
                    @foreach ($staffs as $staff)
                        <tr>
                            <td class="column-first">{{$loop->index}}</td>
                            <td class="column-second">{{$staff->name}}</td>
                            <td class="column-third">{{$staff->email}}</td>
                            <td class="column-fourth">{{$staff->password}}</td>
                            <td class="column-fifth">{{$staff->telephone}}</td>
                            <td class="column-sixth">{{$staff->address}}</td>
                            <td class="column-seventh">
                                @if($staff->status == "active")
                                    <a href="/admin/update-status-staff/{{$staff->id}}"><button type="button" class="btn btn-success" style="height: 37px">Block</button></a>
                                @else
                                    <a href="/admin/update-status-staff/{{$staff->id}}"><button type="button" class="btn btn-warning" style="height: 37px">Active</button></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection