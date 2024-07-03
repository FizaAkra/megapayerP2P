<div class="sidebar-menu">
    <span class="sidebar-menu__close d-lg-none d-block"><i class="las la-times"></i></span>
    <ul class="sidebar-menu-list">
        <li class="sidebar-menu-list__item {{ menuActive('user.home') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.home') }}">
                <span class="icon"><i class="las la-home"></i></span>
                <span class="text">@lang('Dashboard')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.profile.setting') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.profile.setting') }}">
                <span class="icon"><i class="las la-user-cog"></i></span>
                <span class="text">@lang('Account Setting')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.referral.users') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.referral.users') }}">
                <span class="icon"><i class="las la-tree"></i></span>
                <span class="text">@lang('Referral')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.advertisement.index') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.advertisement.index') }}">
                <span class="icon"><i class="lab la-adversal"></i></span>
                <span class="text">@lang('Advertisements')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.withdraw.history') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.withdraw.history') }}">
                <span class="icon"><i class="las la-hand-holding-usd"></i></span>
                <span class="text">@lang('Withdrawals History')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.deposit.history') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.deposit.history') }}">
                <span class="icon"><i class="las la-wallet"></i></span>
                <span class="text">@lang('Deposits History')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.transaction.index') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.transaction.index') }}">
                <span class="icon"><i class="las la-money-bill"></i></span>
                <span class="text">@lang('Transactions')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('ticket.index') }}">
            <a class="sidebar-menu-list__link" href="{{ route('ticket.index') }}">
                <span class="icon"><i class="la la-ticket-alt"></i></span>
                <span class="text">@lang('Support Tickets')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.twofactor') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.twofactor') }}">
                <span class="icon"><i class="las la-lock"></i></span>
                <span class="text">@lang('2FA Security')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.change.password') }}">
            <a class="sidebar-menu-list__link" href="{{ route('user.change.password') }}">
                <span class="icon"><i class="la la-key"></i></span>
                <span class="text">@lang('Change Password')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item">
            <a class="sidebar-menu-list__link" href="{{ route('user.logout') }}">
                <span class="icon"><i class="la la-sign-out-alt"></i></span>
                <span class="text">@lang('Logout') </span>
            </a>
        </li>
    </ul>
</div>
<style>
    /* Sidebar Styles */
    .sidebar-menu {
        background-color: #FEFFFF;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px #1D5550;
        overflow-y: scroll; /* Add scrollbar */
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
    }

    .sidebar-menu::-webkit-scrollbar {
        display: none; /* Hide scrollbar for Chrome, Safari, and Opera */
    }

    .sidebar-menu .sidebar-menu-list__item {
        margin-bottom: 10px;
    }

    .sidebar-menu-list__link {
        display: flex;
        align-items: center;
        color: #1D5550;
        text-decoration: none;
        transition: all 0.3s ease;
        padding: 10px;
        border-radius: 5px;
    }

    .sidebar-menu-list__link:hover {
        background-color: #90A3A2;
        color: #FEFFFF;
    }

    .sidebar-menu-list__link .icon {
        margin-right: 10px;
    }

    .sidebar-menu-list__link .text {
        font-size: 14px; /* Adjust font size */
    }

    /* Close button */
    .sidebar-menu__close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }

    /* Icons */
    .las,
    .la,
    .lab {
        font-size: 18px; /* Adjust icon size */
    }
</style>