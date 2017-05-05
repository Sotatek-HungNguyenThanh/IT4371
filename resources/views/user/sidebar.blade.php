<ul class="x-navigation">
    <li class="xn-logo">
        <a href="/">USER</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="xn-profile">
        <a href="#" class="profile-mini">
            <img src="{{url(Auth::user()->avatar)}}"/>
        </a>
        <div class="profile">
            <div class="profile-image" id="choose_profile">
                <label for="chooseFile" >
                    <img src="{{url(Auth::user()->avatar)}}"/>
                </label>
                <input type="file" class="upload" id="chooseFile" name="fileImg" style="visibility:hidden"/>
            </div>
            <div class="profile-data">
                <div class="profile-data-name">{{Auth::user()->name}}</div>
            </div>
            <div class="profile-controls">
            </div>
        </div>
    </li>
    <li class="xn-title">Account</li>
    <li>
        <a href="/update-info"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Thay đổi thông tin</span></a>
        <a href="/manage-password"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Quản lý mật khẩu</span></a>
        <a href="/history"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Lịch sử giao dịch</span></a>
    </li>
    <li class="xn-title">Transaction</li>
    <li>
        <a href="/add-money"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Gửi tiền vào tài khoản</span></a>
        <a href="/pay"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Thanh toán</span></a>
        <a href="/transfer"><span class="glyphicon glyphicon-tag"></span><span class="xn-text">Chuyển khoản</span></a>
    </li>
</ul>
<script>
    $(document).ready(function () {
        $( "#chooseFile" ).change(function() {
            var img = new FormData();
            img.append('file', $('#chooseFile')[0].files[0]);
            $.ajax({
                method: "POST",
                url: "/update-avatar",
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