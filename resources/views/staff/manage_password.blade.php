@extends('staff.layout')


@section('title')
    Manage password
@endsection

@section('page_content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="container-content">
                    <form action="/staff/update-password" method="post">
                        {{ csrf_field() }}
                        <div class="container-header">
                            Đổi mật khẩu
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
                                    <input type="password" name="old_password" class="form-control" placeholder="Mật khẩu cũ" required>
                                    <input type="password" name="new_password"  class="form-control" placeholder="Mật khẩu mới" required>
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