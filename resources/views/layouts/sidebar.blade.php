<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @php
        $profileSetting = App\Models\ProfileSetting::first();
    @endphp
    <a href="{{ route('home') }}" class="brand-link" style="text-align: center;">
        <img src="{{ url('/').'/storage/app/'.$profileSetting->header_logo}}"
             alt="AFARLTMART LOGO"
             class="brand-image " style="float:none;border-radius:3px;">
        <!--<br><span class="brand-text font-weight-light">{{$profileSetting->company_name}}</span>-->
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
