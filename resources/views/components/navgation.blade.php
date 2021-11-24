<nav class="bg-purple-700 py-3 text-gray-100" x-data="{isMenuOpen: false}">
    <div class="container flex justify-between mx-auto relative lg:px-5">
        <h1 class="text-2xl font-bold">
            <a href="{{ route('home') }}" class="flex items-center">
                <svg class="w-6 h-6 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path
                        d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                    </path>
                </svg>
                LaraJobs
            </a>
        </h1>

        {{-- Mobile navbar --}}
        <div class="md:hidden font-semibold text-lg flex md:flex-row gap-5 items-center md:relative
                absolute flex-col bg-purple-700 left-0 top-0 w-6/12 md:w-auto h-screen md:h-auto transform"
            x-show="isMenuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="-translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="-translate-x-0"
            x-transition:leave-end="-translate-x-full"
            x-transition.duration.500ms
            >


            <div class="md:hidden">
                <a href="{{ route('home') }}" class="flex items-center">
                    <svg class="w-6 h-6 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path
                            d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                        </path>
                    </svg>
                    LaraJobs
                </a>
            </div>
            @guest

                <div class="relative mr-5 hover:text-gray-300 transition-all">
                    <a href="{{ route('login') }}"
                        class="">
                        Login
                    </a>
                </div>

                <div x-cloak x-data="
                        { open: false }" x-on:click.away="open = false" class="relative">
                        <span x-on:click="open = !open"
                            class="cursor-pointer flex items-center px-2 py-1 bg-yellow-600 hover:bg-yellow-700 transition-all rounded">
                            Register
                            <svg :class="{ 'rotate-180': open }" class="w-6 h-6 ml-1 text-white transform transition-all"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </span>
                        {{-- Future drop down --}}
                        <div x-cloak
                            x-show="open"
                            x-transition:enter="transition ease-in duration-200"
                            x-transition:enter-start="opacity-0 scale-90 transform"
                            x-transition:enter-end="opacity-100 scale-100 transform"
                            x-transition:leave="transition duration-200 ease-in-out"
                            x-transition:leave-start="opacity-100 scale-100 transform"
                            x-transition:leave-end="opacity-0 scale-90 transform"
                            class="absolute mt-4 -left-10 w-36 bg-yellow-600 text-gray-50 rounded">
                            <div class="border-b px-3">
                                <a href="{{ route('register') }}">
                                    Register as a user!

                                </a>
                            </div>
                            <div class="border-b px-3">
                                <a href="{{ route('company.create') }}">
                                    Register as a company!
                                </a>
                            </div>
                        </div>
                </div>
            @endguest

            @auth
                @if (auth()->user()->isCompany)
                    <div class="">
                        <a href=" {{ route('job.crate') }}">Create job</a>
                    </div>
                    <div class="">
                        <a href=" {{ route('company.jobs') }}">My Jobs</a>
                    </div>
                @else
                    <div class="">
                        <a href=" {{ route('resume.index') }}">Resume</a>
                    </div>
                    <div class="">
                        <a href=" {{ route('myApplications') }}">Applications</a>
                    </div>
                    <div class="">
                        <a href=" {{ route('invite.index') }}">Invites</a>
                    </div>
                    <div class="">
                        <a href=" {{ route('dashboard.index') }}">Dashboard</a>
                    </div>
                @endif

                <div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="font-semibold">Logout</button>
                    </form>
                </div>
            @endauth
        </div>

        {{-- Desktop navbar --}}
        <div class="hidden md:flex font-semibold text-lg gap-5 bg-purple-700"
            >
            <div class="md:hidden">
                <a href="{{ route('home') }}" class="flex items-center">
                    <svg class="w-6 h-6 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path
                            d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                        </path>
                    </svg>
                    LaraJobs
                </a>
            </div>
            @guest

                <div class="relative mr-5 hover:text-gray-300 transition-all">
                    <a href="{{ route('login') }}"
                        class="">
                        Login
                    </a>
                </div>

                <div x-data="
                        { open: false }" x-on:click.away="open = false" class="relative">
                        <span x-on:click="open = !open"
                            class="cursor-pointer flex items-center px-2 py-1 bg-yellow-600 hover:bg-yellow-700 transition-all rounded">
                            Register
                            <svg :class="{ 'rotate-180': open }" class="w-6 h-6 ml-1 text-white transform transition-all"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </span>
                        {{-- Future drop down --}}
                        <div x-cloak x-show="open"
                            x-transition:enter="transition ease-in duration-200"
                            x-transition:enter-start="opacity-0 scale-90 transform"
                            x-transition:enter-end="opacity-100 scale-100 transform"
                            x-transition:leave="transition duration-200 ease-in-out"
                            x-transition:leave-start="opacity-100 scale-100 transform"
                            x-transition:leave-end="opacity-0 scale-90 transform"
                            class="absolute mt-4 -left-10 w-36 bg-purple-700 text-gray-50 rounded">
                            <div class="border-b px-3">
                                <a href="{{ route('register') }}">
                                    Register as a user!
                                </a>
                            </div>
                            <div class="border-b px-3">
                                <a href="{{ route('company.create') }}">
                                    Register as a company!
                                </a>
                            </div>
                        </div>
                </div>
            @endguest

            @auth
                @if (auth()->user()->isCompany)
                    <div class="">
                        <a href=" {{ route('job.crate') }}">Create job</a>
                    </div>
                    <div class="">
                        <a href=" {{ route('company.jobs') }}">My Jobs</a>
                    </div>
                @else
                    <div class="">
                        <a href=" {{ route('resume.index') }}">Resume</a>
                    </div>
                    <div class="">
                        <a href=" {{ route('myApplications') }}">Applications</a>
                    </div>
                    <div class="">
                        <a href=" {{ route('invite.index') }}">Invites</a>
                    </div>
                    <div class="">
                        <a href=" {{ route('dashboard.index') }}">Dashboard</a>
                    </div>
                @endif

                <div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="font-semibold">Logout</button>
                    </form>
                </div>
            @endauth
        </div>

        <div class="flex items-center md:hidden" x-on:click="isMenuOpen = !isMenuOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </div>
</nav>
