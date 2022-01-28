<label for="menuDashboard" class="hidden">{!! __('messages.dashboard_workerz.openMenu')!!}</label><input id="menuDashboard" type="checkbox"
                                                                          class="menuDashboard hiddenCheckbox">
<nav>
    <h2 class="hidden">{!! __('messages.nav_first')!!}</h2>
    <li class="container-nav-principal">
        <ul class="full-height">
            <li class="container-list-menu full-height">
                <ul class="container-list-menu container-list-menu-principal container-menu-pincipal">
                    <li><a title="{!! __('messages.dashboard_workerz.page__dashboard')!!}"
                           class="iconeDashboard icone-home-dashboard {{ Request::is('dashboard') ? "current_page_item_dashboard" : "" }}"
                           {{ Request::is('dashboard')? "aria-current='page'" : "" }} href="{{ route('dashboard') }}"><span>{!! __('messages.dashboard_workerz.title__index')!!}</span></a>
                    </li>
                    <li>
                        <a title="{!! __('messages.dashboard_workerz.page__notifications')!!}"
                           class="iconeDashboard icone-notifications-dashboard {{ Request::is('dashboard/notifications') || Request::is('dashboard/notifications/*') ? "current_page_item_dashboard" : "" }}"
                           {{ Request::is('dashboard/notifications') || Request::is('dashboard/notifications/*') ? "aria-current='page'" : "" }} href="{{route('dashboard.notifications')}}"><span>{!! __('messages.dashboard_workerz.notifications__title')!!}</span>
                            @if(count($notificationsReaded) > 9 && count($notificationsReaded) > 0)
                                <span class="counter-read-message">
                                    9+
                                </span>
                            @else
                                @if(count($notificationsReaded))
                                    <span class="counter-read-message">
                                    {{count($notificationsReaded)}}
                                </span>
                                @endif
                            @endif
                        </a>
                    </li>
                    <li>
                        <a title="{!! __('messages.dashboard_workerz.page__msg')!!}"
                           class="iconeDashboard icone-messages-dashboard {{ Request::is('dashboard/messages') || Request::is('dashboard/messages/*') ? "current_page_item_dashboard" : "" }}"
                           {{ Request::is('dashboard/messages') || Request::is('dashboard/messages/*') ? "aria-current='page'" : "" }} href="{{route('dashboard.messages')}}"><span>{!! __('messages.contact.label__msg')!!}</span>
                            @if($noReadMsgs > 9 && $noReadMsgs > 0)
                                <span class="counter-read-message">
                                    9+
                                </span>
                            @else
                                @if($noReadMsgs)
                                    <span class="counter-read-message">
                                        {{$noReadMsgs}}
                                    </span>
                                @endif
                            @endif
                        </a>
                    </li>
                    <li>
                        <a title="{!! __('messages.dashboard_workerz.page__ads')!!}"
                           class="iconeDashboard icone-ads-dashboard {{ Request::is('dashboard/ads') || Request::is('dashboard/ads/*') ? "current_page_item_dashboard" : "" }}"
                           {{ Request::is('dashboard/ads') || Request::is('dashboard/ads/*') ? "aria-current='page'" : "" }} href="{{route('dashboard.ads')}}"><span>{!! __('messages.dashboard_workerz.ads__title')!!}</span></a>
                    </li>
                    <li>
                        <a title="{!! __('messages.dashboard_workerz.page__profil')!!}"
                           class="iconeDashboard icone-profil-dashboard {{ Request::is('dashboard/profil') || Request::is('dashboard/profil/*') ? "current_page_item_dashboard" : "" }}"
                           {{ Request::is('dashboard/profil') || Request::is('dashboard/profil/*') ? "aria-current='page'" : "" }} href="{{route('dashboard.profil')}}"><span>{!! __('messages.dashboard_workerz.profil__title')!!}</span></a>
                    </li>
                    <li class="container-logout-dash">
                        <form aria-label="{!! __('messages.auth.logout')!!}" role="form" id="logout-form"
                              action="{{route('logout')}}" method="POST"> @csrf
                            <button type="submit" role="button" title="{!! __('messages.auth.logout')!!}"
                                    class="iconeDashboard deconnexionButtonDashboard">
                                {!! __('messages.auth.logout')!!}
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</nav>
