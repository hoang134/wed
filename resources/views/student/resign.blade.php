<!DOCTYPE html>
<html>
<head>
    <title>Subject Register</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cssMain.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="http://www.prthuonghieu.com/js-noel/snow.mini.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src={{ asset("js/noel/haloRegister.js") }}></script>
</head>
<body>
<div class="heade">
    <div class="logo">
        <a href="">
            <img src="{{ asset('image/logo.png') }}">
        </a>
    </div>
    <div class="text">
        <h2>TRANG ĐĂNG KÝ THI KẾT THÚC HỌC PHẦN VNU</h2>
    </div>
</div>
<hr>

<div class="content">

    <div>
        <form action="/search" method="POST">
            @csrf
            <input type="text" name="searchSubject">
            <input type="submit" value="Tìm Kiếm">
        </form>

    </div>

    <div class="main" id="main">
        @if(!$subjects->isEmpty())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Môn Học</th>
                    <th scope="col">Mã Môn Học</th>
                    <th scope="col">Thời Gian</th>
                    <th scope="col">Phòng Thi</th>
                    <th scope="col">Số Lượng</th>
                    <th scope="col">Thao Tác</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                ?>
                @foreach($subjects as $subject)
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td>{{ $subject->name}}</td>
                        <td>{{ $subject->code}}</td>
                        <td>{{ $subject->time}}</td>
                        <td>{{ $subject->quantity}}</td>
                        <td>{{ $subject->room}}</td>
                        <td>
                            <button class="btnSubject btn btn-success" value="{{ $subject->id }}">Thêm</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h5 class="text-center">Không có dữ liệu</h5>
        @endif
    </div>

    <h5 class="text-center mt-3" style="color: #047f48">Môn bạn đã đăng ký</h5>
    <span id="error"  style="font-size: 20px;margin-left: 580px; "></span>
    <div class="main2" >

        <table id="main2" class="table table-striped">
            <thead>
                <tr >
                    <th scope="col">STT</th>
                    <th scope="col">Tên Môn Học</th>
                    <th scope="col">Mã Môn Học</th>
                    <th scope="col">Thời Gian</th>
                    <th scope="col">Phòng Thi</th>
                    <th scope="col">Số Lượng</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody id="subjectRegister">
            </tbody>
        </table>
        <a href="/exam-register">
            <button type="button" class="btn btn-primary" style="float: right; margin-right: 90px" >Xác  Nhận </button></a>

    </div>
</div>
<div class="footer"  style="text-align: center">
    <hr style="margin-top: 3px">
    Công thông tin đào tạo ĐHQG Hà Nội - Phát triển bởi Trung tâm Ứng dụng CNTT @2011
    -
    2019
    <br>
    144 đường Xuân Thủy, Quận Cầu Giấy, Hà Nội, Việt Nam
    <br>
    Webmaster: support@vnu.edu.vn
    <br>
</div>
	<script type="text/javascript" src="{{ asset('js/mainJs.js') }}"></script>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btnSubject').click(function () {
        var check =document.getElementById('error').innerHTML;
        if(check=="đăng ký thành công") {
            var id = $(this).val();
            $.ajax({
                url: '/registration',
                method: 'POST',
                data: {
                    userId: 1,
                    subjectId: id
                }
            }).done(function (res) {
                loadSubjectRegister();
            }).fail(function (err) {
                console.log('Loi');
            });
        }
    });
    $(document).on('click','.btnDelete', function () {
        var id = $(this).val();
        $.ajax({
            url: '/registration',
            method:'DELETE',
            data: {
                subjectId: id,
            }
        }).done(function (res) {
            loadSubjectRegister();
            console.log(res);
        }).fail(function (err) {
            console.log(err);
        })
    });

    $(document).ready(function () {
        loadSubjectRegister();
    });

    function loadSubjectRegister() {
        $.ajax({
            url: '/subject-register',
            method: 'GET',
        }).done(function (res) {
            console.log(res);
            $('#subjectRegister').empty();
            $.each(res, function( index, value ) {
                $('#subjectRegister').append('<tr>\n' +
                    '                    <th scope="row">' + (index + 1) + '</th>\n' +
                    '                    <td>' + value.name + '</td>\n' +
                    '                    <td class="subjectCode">' + value.code + '</td>\n' +
                    '                    <td  class="subjectTimes">' + value.time + '</td>\n' +
                    '                    <td>' + value.room + '</td>\n' +
                    '                    <td>' + value.quantity + '</td>\n' +
                    '                    <td>\n' +
                    '                        <button class="btnDelete btn btn-danger" value="' + value.id + '">Xóa</button>\n' +
                    '                    </td>\n' +
                    '                </tr>')
            });

        }).fail(function (err) {
            console.log(err);
        });
    }
</script>
