@extends('admin.layout')


@section('title')
    Create Staff
@endsection

@section('page_content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="container-content">
                    <form action="/admin/create-staff" method="post">
                        {{ csrf_field() }}
                        <div class="container-header">
                            Tạo nhân viên mới
                        </div>
                        <div class="container-body">
                            @if(Session::has('alert-success'))
                                <script>
                                    $(document).ready(function () {
                                        $("#message_success").html("Success!");
                                        $("#notification_success").modal();
                                        setTimeout(function(){
                                            $("#notification_success").modal("hide");
                                        }, 1000);
                                    });
                                </script>
                            @endif
                            @if (count($errors) > 0)
                                <script>
                                    $(document).ready(function () {
                                        $("#message_error").html("Error! Email đã tồn tại");
                                        $("#notification_error").modal();
                                        setTimeout(function(){
                                            $("#notification_error").modal("hide");
                                        }, 1000);
                                    });
                                </script>
                            @endif
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                    <input type="email" name="email"  class="form-control" placeholder="Email" required>
                                    <input type="text" name="telephone"  class="form-control"
                                           minlength="10" maxlength="11" pattern="[0-9]{10,11}" title="Telephone is between 10 and 11 digit" placeholder="Telephone">
                                    <input type="text" name="address"  class="form-control" placeholder="Address">
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