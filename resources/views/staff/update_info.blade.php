@extends('staff.layout')


@section('title')
    Update Info
@endsection

@section('script')
    <script type="text/javascript" src="/js/angular/staff/AccountController.js"></script>
@endsection
@section('page_content')
    <div class="row" ng-controller="AccountController as controller">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="container-content">
                    <form action="/staff/update-account-info" method="post">
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
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control" placeholder="Name" required
                                               ng-model="controller.account.name">
                                        <input type="email" name="email" class="form-control" placeholder="Email" disabled
                                               ng-model="controller.account.email">
                                        <input type="text" class="form-control" placeholder="Điện thoại"
                                               name="telephone" pattern="[0-9]{10,11}" title="Telephone is between 10 and 11 digit"
                                               minlength="10" maxlength="11" required ng-model="controller.account.telephone">
                                        <input type="text" name="address" class="form-control" placeholder="Address"
                                               ng-model="controller.account.address">
                                    </div>
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