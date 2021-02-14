@extends("admin.main");
@section("content-2")

    <div id="categoryApp" dir="rtl">


        <router-view></router-view>

    </div>
@endsection


@section("scripts")
    <script src="{{ asset('js/adminApp/categories.js') }}" defer></script>
@endsection
