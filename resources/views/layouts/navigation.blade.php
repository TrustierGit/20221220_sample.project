
<!-- <nav x-data="{ open: false }" class="bg-indigo-800"> -->
<!-- <nav x-data="{ open: false }" class="user_authority"> -->

<nav x-data="{ open: false }" class="<?= config('maintenance.user_mode')[Auth::user()->mode_admin];?>" style =" border-bottom-width: medium;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Navigation Links -->
                @can('user')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('ダッシュボード') }}
                    </x-nav-link>
                </div>
                @endcan
                @can('admin-higher')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('reservation.download')" :active="request()->routeIs('reservation.download')">
                        {{ __('予約履歴') }}
                    </x-nav-link>
                </div>
                @endcan
                @can('admin-higher')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('notification.create')" :active="request()->routeIs('notification.create')">
                        {{ __('お知らせ投稿') }}
                    </x-nav-link>
                </div>
                @endcan
                @can('user')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('reservation')" :active="request()->routeIs('reservation')">
                        {{ __('予約登録') }}
                    </x-nav-link>
                </div>
                @endcan
                @can('user')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('download_link')" :active="request()->routeIs('password.change')">
                        {{ __('ダウンロード') }}
                    </x-nav-link>
                </div>
                @endcan
                @can('admin-higher')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('password.change')" :active="request()->routeIs('password.change')">
                        {{ __('パスワード変更') }}
                    </x-nav-link>
                </div>
                @endcan
                @can('superuser')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('ResetKey')" :active="request()->routeIs('ResetKey')">
                        {{ __('APIキーリセット') }}
                    </x-nav-link>
                </div>
                @endcan
                @can('superuser')
                <div class="hidden sm:-my-px sm:flex">
                    <x-nav-link :href="route('UserProvisioning')" :active="request()->routeIs('UserProvisioning')">
                        {{ __('プロビジョニング') }}
                    </x-nav-link>
                </div>
                @endcan

                

            </div>
           
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                    <button class="flex items-center font-semibold text-white hover:text-gray-700 hover:border-gray-200 focus:outline-none focus:text-gray-700 focus:border-gray-500 transition duration-150 ease-in-out">
                    <div class="w-8 h-8 inline-flex items-center justify-center rounded-full bg-gray-200 text-indigo-500 mb-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 text-indigo-900 bg-gray-200" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            </div>
                    </button>

                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <div class="bg-gray-100">
                        <div class="border-b px-4">
                        @isset(Auth::user()->organization->name_organization)
                            <div class="text-lg px-4">{{ Auth::user()->organization->name_organization }}</div>
                        @else
                        <div class="text-lg px-4">{{ Auth::user()->domain_organization }}</div>
                        @endisset
                            <div class="text-lg px-4">{{ Auth::user()->name }}</div>
        
                        </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('ダッシュボード') }}
            </x-responsive-nav-link>
            @can('admin-higher')
            <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('reservation.download')" :active="request()->routeIs('reservation.download')">
                        {{ __('予約履歴') }}
            </x-nav-link>
            @endcan
            @can('admin-higher')
            <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('notification.create')" :active="request()->routeIs('notification.create')">
                        {{ __('お知らせ投稿') }}
            </x-nav-link>
            @endcan
            @can('user')
            <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('reservation')" :active="request()->routeIs('reservation')">
                        {{ __('予約登録') }}
            </x-nav-link>
            @endcan
            @can('user')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('download_link')" :active="request()->routeIs('password.change')">
                        {{ __('ダウンロード') }}
                    </x-nav-link>
                </div>
                @endcan
            @can('admin-higher')
            <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('password.change')" :active="request()->routeIs('password.change')">
                        {{ __('パスワード変更') }}
            </x-nav-link>
            @endcan

            
            
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="border-b px-4">
                        @isset(Auth::user()->organization->name_organization)
                            <div class="text-lg px-4">{{ Auth::user()->organization->name_organization }}</div>
                        @else
                        <div class="text-lg px-4">{{ Auth::user()->domain_organization }}</div>
                        @endisset
                            <div class="text-lg px-4">{{ Auth::user()->name }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
