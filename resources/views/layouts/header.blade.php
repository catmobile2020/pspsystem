<!-- Main header -->
<div class="main-header row">
    <div class="col-sm-6">

        <!-- User info -->

        <!-- /user info -->

    </div>

    <div class="col-sm-6 col-xs-5">
        <div class="pull-right">
            <ul class="user-info pull-left">

                <!-- Notifications -->
                 <notify></notify>
                <!-- /notifications -->
            </ul>
            <ul class="user-info pull-right">
                <li class="profile-info dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                        @if (auth('admin')->check())
                            {{auth('admin')->user()->name}}
                        @elseif(auth('callcenter')->check())
                            {{auth('callcenter')->user()->name}}
                        @else
                            {{auth('web')->user()->name}}
                        @endif
                    </a>
                    |
                </li>

                <li>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                         Logout <i class="icon-logout"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /main header -->
