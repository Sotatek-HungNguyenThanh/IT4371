@extends('admin.layout')


@section('title')
    Home
@endsection

@section('script')

@endsection

@section('page_content')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form class="form-horizontal" action="/admin/update-password" method="post">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Thay đổi mật khẩu</strong></h3>
                    </div>
                    <div class="panel-body">
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
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Mật khẩu cũ</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                    <input type="password" name="old_password" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Mật khẩu mới</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                    <input type="password" name="new_password" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <button class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>
@endsection