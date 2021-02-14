@extends("admin.main");
@section("content-2")

    <div id="configApp" dir="rtl">


        <router-view></router-view>

    </div>
@endsection


@section("scripts")
    <script src="{{ asset('js/adminApp/configs.js') }}" defer></script>
@endsection
