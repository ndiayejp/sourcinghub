<nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                <i class="material-icons">notifications</i>
                                <span class="label-count">{{ Auth::user()->unreadNotifications->count() }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">{{ __('NOTIFICATIONS') }}</li>
                                   <li class="body">
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 254px;">
                                            <ul class="menu" style="overflow: hidden; width: auto; height: 254px;">
                                                @foreach (Auth::user()->unreadNotifications as $notification)
                                                <li>
                                                    <a href="{{ route('notifications.show',['id'=>$notification->id]) }}">
                                                        {{ ($notification->type)::toText($notification->data) }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        <div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 0px; z-index: 99; right: 1px;"></div>
                                        <div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                                    </div>
                                </li>  
                            </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>