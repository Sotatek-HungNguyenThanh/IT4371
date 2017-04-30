@extends('user.layout')


@section('title')
    Home
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

@section('page_content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="container-content">
                    <form>
                        <div class="container-header">
                            Thông tin cá nhân
                        </div>
                        <div class="container-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Email">
                                    <input type="text" class="form-control" placeholder="Điện thoại">
                                    <input type="text" class="form-control" placeholder="Địa chỉ">
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