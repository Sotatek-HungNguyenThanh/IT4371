@extends('admin.layout')


@section('title')
    Update Info
@endsection

@section('css')
    <style>
        input.form-control, textarea.form-control {
            border-radius: 2px;
            padding: 10px 15px;
            height: auto;
            font-size: 1em;
            line-height: auto;
            border: 1px solid #c8d1d3;
            background-color: transparent;
            box-shadow: none;
            margin-bottom: 15px;
        }
        .container-content{
            width: 100%;
            background-color: #FFF;
            border-radius: 3px;
            box-shadow: 0 1px 2px #c8d1d3;
        }
        .container-header{
            padding: 30px;
            font-size: 1.1em;
            font-weight: 400;
            border-bottom: 1px solid #dfe6e8;
            border-left: 0px solid transparent;
            color: #666;
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: row;
            flex-direction: row;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start;
        }
        .container-body{
            padding: 30px;
        }
        .form-horizontal .form-group {
            margin-right: -15px;
            margin-left: -15px;
        }
        .btn {
            padding: 10px 30px;
            border-radius: 0;
            border-width: 1px;
            border-style: solid;
            border-color: transparent;
            border-radius: 3px;
            box-shadow: 0 2px 3px rgba(223, 230, 232, 0.3);
            margin-bottom: 5px;
            transition: all .3s ease;
        }
        .btn.btn-primary {
            border-color: #095077;
            border-bottom-color: #043D5D;
            background-color: #095077;
            box-shadow: 0 2px 3px rgba(9, 80, 119, 0.3);
        }
    </style>
@endsection
@section('script')
    <script type="text/javascript" src="/js/angular/admin/AccountController.js"></script>
@endsection
@section('page_content')
    <div class="row" ng-controller="AccountController as controller">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="container-content">
                    <form action="/admin/update-account-info" method="post">
                        {{ csrf_field() }}
                        <div class="container-header">
                            Thông tin cá nhân
                        </div>
                        <div class="container-body">
                            @if(Session::has('alert-success'))
                                <div class="alert alert-success">
                                    <strong>Success!</strong> {{Session::get('alert-success') }}
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required
                                           ng-model="controller.account.name">
                                    <input type="email" name="email" class="form-control" placeholder="Email" disabled
                                           ng-model="controller.account.email">
                                    <input type="text" class="form-control" placeholder="Điện thoại"
                                           name="telephone" pattern="[0-9]{10,11}"
                                           minlength="10" maxlength="11" required ng-model="controller.account.telephone">
                                    <input type="text" name="address" class="form-control" placeholder="Address"
                                           ng-model="controller.account.address">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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