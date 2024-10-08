<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
                <button id="sidebar-toggle"
                    class="sidebar-toggle me-3 btn btn-icon-only d-none d-lg-inline-block align-items-center justify-content-center">
                    <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

            </div>
            @php
                $notifications = Auth::user()->unreadNotifications ;
            @endphp
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown" id="notificationDropdownsss">
                    <a class="nav-link text-dark notification-bell @if (count($notifications) != 0) unread @endif dropdown-toggle"
                        id="unReadNotificationDropdown"  data-unread-notifications="true" href="#" role="button"
                        data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <svg class="icon icon-sm text-gray-900" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                            </path>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0"
                        style="top: 100%;right: 9px;left: -9px;" id="notificationData">
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="text-center text-primary fw-bold border-bottom border-light py-3">Notifications</a>

                            @forelse ($notifications as $notification)

                                <a href="{{route('dashboard.reviews.index')}}?search={{ $notification->data['review']['id'] }}" class="list-group-item list-group-item-action border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-auto"> <img alt="Image placeholder"
                                                src="{{ asset('front/img/avatar.svg') }}" class="avatar-md rounded">
                                        </div>
                                        <div class="col ps-0 ms-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="h6 mb-0 text-small">
                                                        {{ $notification->data['user']['username'] }}</h4>
                                                </div>
                                                <div class="text-end"><small
                                                        class="text-danger">{{ $notification->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <p class="font-small mt-1 mb-0">
                                                {{ Str::limit($notification->data['review']['comment'], 30) }}</p>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                            @empty
                                <h6 class="text-center mt-3">No notifications</h6>
                            @endforelse
                            <a href="{{ route('dashboard.reviews.index') }}"
                                class="dropdown-item text-center fw-bold rounded-bottom py-3 bg-gray-200">
                                <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                View all
                            </a>

                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="avatar rounded-circle" alt="Image placeholder"
                                src="{{ asset('dashboard/assets') }}/img/team/profile-picture-3.jpg">
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block"><span
                                    class="mb-0 font-small fw-bold text-gray-900">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item d-flex align-items-center">
                                <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>

    $("#unReadNotificationDropdown").click(function() {
        $.ajax({
            type: "POST",
            url: "{{ route('dashboard.read.notification') }}",
            data: {
                _token: "{{ csrf_token() }}",
            }
        });
        $("#unReadNotificationDropdown").removeClass("unread");


    })
</script>
