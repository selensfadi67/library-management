<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">


    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <!--end: Notifications -->

        <!--end: Quick panel toggler -->

        <!--begin: Language bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon">
                    <img class="" src="{{ asset('assets/media/flags/' . (app()->getLocale() == 'ar' ? '016-palestine.png' : '020-flag.svg')) }}" alt="" />
                </span>
            </div>
            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    <li class="kt-nav__item {{ app()->getLocale() == 'en' ? 'kt-nav__item--active' : '' }}">
                        <a href="{{ route('admin.dashboard', 'en') }}" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="{{ asset('assets/media/flags/020-flag.svg') }}"
                                    alt="" /></span>
                            <span class="kt-nav__link-text">English</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ app()->getLocale() == 'ar' ? 'kt-nav__item--active' : '' }}">
                        <a href="{{ route('admin.dashboard', 'ar') }}" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="{{ asset('assets/media/flags/016-palestine.png') }}"
                                    alt="" /></span>
                            <span class="kt-nav__link-text">Arabic</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!--end: Language bar -->

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">{{ __('messages.welcome_admin') }}</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ auth()->user()->name }}</span>

                    </div>
            </div>
            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                    style="background-image: url({{ asset('assets/media/misc/bg-1.jpg') }})">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_25.jpg') }}" />

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="kt-user-card__name">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="kt-user-card__badge">
                        <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                    </div>
                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                My Profile
                            </div>
                            <div class="kt-notification__item-time">
                                Account settings and more
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-mail kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                My Messages
                            </div>
                            <div class="kt-notification__item-time">
                                Inbox and tasks
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-rocket-1 kt-font-danger"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                My Activities
                            </div>
                            <div class="kt-notification__item-time">
                                Logs and notifications
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-hourglass kt-font-brand"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                My Tasks
                            </div>
                            <div class="kt-notification__item-time">
                                latest tasks and projects
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-cardiogram kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                Billing
                            </div>
                            <div class="kt-notification__item-time">
                                billing & statements <span
                                    class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2
                                    pending</span>
                            </div>
                        </div>
                    </a>
                    <div class="kt-notification__custom kt-space-between">
                        <form method="POST" action="{{ route('admin.logout', app()->getLocale()) }}" class="inline">
                            @csrf
                            <button type="submit" class="btn btn-label btn-label-brand btn-sm btn-bold">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                        <a href="{{ route('home', app()->getLocale()) }}" target="_blank"
                            class="btn btn-clean btn-sm btn-bold">{{ __('messages.back_home') }}</a>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>

<!-- end:: Header -->
