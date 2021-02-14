@extends("layouts.app")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="card ">
                    <div class="card-header" style="font-size: 25px">
                        القائمة
                    </div>
                    <div class="card-body" style="padding: 0">
                        <ul style="list-style: none;color: black; padding-right:20px " class="link">
                            <li><a href="http://127.0.0.1:8000/admin/categories#/">الاعمال</a></li>
                            <li><a href="http://127.0.0.1:8000/admin/categories#/create-category">اضافةاعمال</a></li>
                            <li><a href="http://127.0.0.1:8000/admin/configs#/">الاعدادات</a></li>
                            <li><a href="http://127.0.0.1:8000/admin/configs#/create-config">اضافة اعدادات</a></li>
                            <li><a href="http://127.0.0.1:8000/admin/configs#/create-theme">اضافة ثيم</a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-9">
                @yield("content-2")
            </div>
        </div>
    </div>
@endsection
