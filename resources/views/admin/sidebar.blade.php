<ul class="x-navigation">
    <li class="xn-logo">
        <a href="/">ADMIN</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="xn-profile">
        <a href="#" class="profile-mini">
            <img src="{{url(Auth::guard('admin')->user()->avatar)}}"/>
        </a>
        <div class="profile">
            <div class="profile-image" id="choose_profile">
                <label for="chooseFile" >
                    <img src="{{url(Auth::guard('admin')->user()->avatar)}}"/>
                </label>
                <input type="file" class="upload" id="chooseFile" name="fileImg" style="visibility:hidden"/>
            </div>
            <div class="profile-data">
                <div class="profile-data-name">{{Auth::guard('admin')->user()->name}}</div>
            </div>
            <div class="profile-controls">
            </div>
        </div>
    </li>
    <li class="xn-title">Account</li>
    <li>
        <a href="/admin/update-info"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Thay đổi thông tin</span></a>
        <a href="/admin/manage-password"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Quản lý mật khẩu</span></a>
    </li>
    <li class="xn-title">Manage Database</li>
    <li>
        <a href="/admin/manage-database"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Manage Database</span></a>
    </li>
    <li class="xn-title">Manage Staff</li>
    <li>
        <a href="/admin/create-staff"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Thêm nhân viên</span></a>
    </li>
    <li>
        <a href="/admin/list-staff"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Danh sách nhân viên</span></a>
    </li>
    <li class="xn-title">Manage Customers</li>
    <li>
        <a href="/admin/create-customer"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Thêm khách hàng</span></a>
    </li>
    <li>
        <a href="/admin/list-user"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Danh sách khách hàng</span></a>
    </li>
</ul>
<script>
    $(document).ready(function () {
        $( "#chooseFile" ).change(function() {
            var img = new FormData();
            img.append('file', $('#chooseFile')[0].files[0]);
            $.ajax({
                method: "POST",
                url: "/admin/update-avatar",
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                data: img,
                success: function (data) {
                    $('#chooseFile').val('');
                    location.reload();
                }
            });
        });
    });
</script>