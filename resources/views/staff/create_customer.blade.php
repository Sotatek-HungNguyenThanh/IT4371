@extends('staff.layout')


@section('title')
    Create Customer
@endsection

@section('page_content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="container-content">
                    <form action="/staff/create-customer" method="post">
                        {{ csrf_field() }}
                        <div class="container-header">
                            Tạo khách hàng mới
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
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                    <input type="email" name="email"  class="form-control" placeholder="Email" required>
                                    <input type="text" name="telephone"  class="form-control"
                                           minlength="10" maxlength="11" pattern="[0-9]{10,11}" title="Telephone is between 10 and 11 digit" placeholder="Telephone">
                                    <input type="text" name="address"  class="form-control" placeholder="Address">
                                    <input type="text" name="balance" pattern="[0-9]*" title="Balance is number"  class="form-control" placeholder="Balance" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
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