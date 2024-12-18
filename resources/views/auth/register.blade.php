<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets') }}/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body class="font-poppins text-[#0A090B]">
    <section id="signup" class="flex w-full min-h-[832px] relative">
        <nav class="flex items-center px-[50px] pt-[30px] w-full absolute top-0">
            <div class="flex items-center">
                <a href="index.html">
                    <img src="{{ asset('assets') }}/images/logo/logo.svg" alt="logo">
                </a>
            </div>
            <div class="flex items-center justify-end w-full">
                <ul class="flex items-center gap-[30px]">
                    <li>
                        <a href="" class="font-semibold text-white">Docs</a>
                    </li>
                    <li>
                        <a href="" class="font-semibold text-white">About</a>
                    </li>
                    <li>
                        <a href="" class="font-semibold text-white">Help</a>
                    </li>
                    <li class="h-[52px] flex items-center">
                        <a href="signin.html"
                            class="font-semibold text-white p-[14px_30px] bg-[#0A090B] rounded-full text-center">Sign
                            In</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="left-side min-h-screen flex flex-col w-full pb-[30px] pt-[82px]">
            <div class="h-full w-full flex items-center justify-center">
                <form method="POST" action="{{ route('register') }}"
                    class="flex flex-col gap-[30px] w-[450px] shrink-0">
                    @csrf
                    <h1 class="font-bold text-2xl leading-9">Sign Up</h1>
                    <div class="flex flex-col gap-2">
                        <p class="font-semibold">Complete Name</p>
                        <div
                            class="flex items-center w-full h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                            <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets') }}/images/icons/profile.svg"
                                    class="h-full w-full object-contain" alt="icon">
                            </div>
                            <input type="text"
                                class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                                placeholder="Write your correct input here" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="text-red-500 text-sm mt-1">
                            {{ $errors->first('name') }}
                        </div>

                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-semibold">Email Address</p>
                        <div
                            class="flex items-center w-full h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                            <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets') }}/images/icons/sms.svg"
                                    class="h-full w-full object-contain" alt="icon">
                            </div>
                            <input type="email"
                                class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                                placeholder="Write your correct input here" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="text-red-500 text-sm mt-1">
                            {{ $errors->first('email') }}
                        </div>

                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-semibold">Password</p>
                        <div
                            class="flex items-center w-full h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                            <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets') }}/images/icons/lock.svg"
                                    class="h-full w-full object-contain" alt="icon">
                            </div>
                            <input type="password"
                                class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                                placeholder="Write your correct input here" name="password">
                        </div>
                        <div class="text-red-500 text-sm mt-1">
                            {{ $errors->first('password') }}
                        </div>

                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-semibold">Confirm Password</p>
                        <div
                            class="flex items-center w-full h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                            <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets') }}/images/icons/lock.svg"
                                    class="h-full w-full object-contain" alt="icon">
                            </div>
                            <input type="password"
                                class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                                placeholder="Write your correct input here" name="password_confirmation">
                        </div>
                        <div class="text-red-500 text-sm mt-1">
                            {{ $errors->first('password_confirmation') }}
                        </div>

                    </div>
                    <button type="submit"
                        class="w-full h-[52px] p-[14px_30px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Create
                        My Account</button>
                </form>
            </div>
        </div>
        <div class="right-side min-h-screen flex flex-col w-[650px] shrink-0 pb-[30px] pt-[82px] bg-[#6436F1]">
            <div class="h-full w-full flex flex-col items-center justify-center pt-[66px] gap-[100px]">
                <div class="w-[500px] h-[360px] flex shrink-0 overflow-hidden">
                    <img src="{{ asset('assets') }}/images/thumbnail/sign-in-illustration.png"
                        class="w-full h-full object-contain" alt="banner">
                </div>
                <div class="logos w-full overflow-hidden">
                    <div class="group/slider flex flex-nowrap w-max items-center">
                        <div
                            class="logo-container animate-[slide_15s_linear_infinite] group-hover/slider:pause-animate flex gap-10 pl-10 items-center flex-nowrap">
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-51.svg" alt="logo">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-51-1.svg" alt="logo">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-52.svg" alt="logo">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-52-1.svg" alt="logo">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-51.svg" alt="logo">
                            </div>
                        </div>
                        <div
                            class="logo-container animate-[slide_15s_linear_infinite] group-hover/slider:pause-animate flex gap-10 pl-10 items-center flex-nowrap">
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-51.svg" alt="logo">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-51-1.svg" alt="logo">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-52.svg" alt="logo">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-52-1.svg" alt="logo">
                            </div>
                            <div class="w-fit flex shrink-0">
                                <img src="{{ asset('assets') }}/images/logo/logo-51.svg" alt="logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
