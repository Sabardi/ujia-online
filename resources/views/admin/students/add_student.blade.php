<x-app-layout>
    <div id="menu-content" class="flex flex-col w-full pb-[30px]">
        <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
            <form class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
                <input type="text"
                    class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                    placeholder="Search by report, student, etc" name="search">
                <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                    <img src="{{ asset('assets') }}/images/icons/search.svg" alt="icon">
                </button>
            </form>
            <div class="flex items-center gap-[30px]">
                <div class="flex gap-[14px]">
                    <a href=""
                        class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                        <img src="{{ asset('assets') }}/images/icons/receipt-text.svg" alt="icon">
                    </a>
                    <a href=""
                        class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                        <img src="{{ asset('assets') }}/images/icons/notification.svg" alt="icon">
                    </a>
                </div>
                <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
                <div class="flex items-center gap-3">
                    <div class="flex flex-col text-right">
                        <p class="text-sm text-[#7F8190]">Howdy</p>
                        <p class="font-semibold">Fany Alqo</p>
                    </div>
                    <div class="w-[46px] h-[46px]">
                        <img src="{{ asset('assets') }}/images/photos/default-photo.svg" alt="photo">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-10 px-5 mt-5">
            <div class="breadcrumb flex items-center gap-[30px]">
                <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                <a href="{{ route('dashboard.courses.index') }}"
                    class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage Courses</a>
                <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Course
                    Students</a>
            </div>
        </div>
        <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
            <div class="flex items-center gap-6">
                <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                    <img src="{{ Storage::url($course->cover) }}" class="object-contain w-full h-full" alt="icon">
                    <p
                        class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap">
                        {{ $course->category->name }}</p>
                </div>
                <div class="flex flex-col gap-5">
                    <h1 class="font-extrabold text-[30px] leading-[45px]">{{ $course->name }}</h1>
                    <div class="flex items-center gap-5">
                        <div class="flex gap-[10px] items-center">
                            <div class="flex w-6 h-6 shrink-0">
                                <img src="{{ asset('assets') }}/images/icons/calendar-add.svg" alt="icon">
                            </div>
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($course->created_at)->format('F j, Y') }}</p>
                        </div>
                        <div class="flex gap-[10px] items-center">
                            <div class="flex w-6 h-6 shrink-0">
                                <img src="{{ asset('assets') }}/images/icons/profile-2user-outline.svg" alt="icon">
                            </div>
                            {{-- <p class="font-semibold">{{ $course->students->count() }}</p> --}}
                            <p class="font-semibold">{{ count($student) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="p-4 mb-4 bg-red-800 rounded text-white-800">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (session('success'))
            <div class="p-4 mb-4 text-white bg-green-500 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('dashboard.course.course.student.store', $course) }}" method="post" id="add-question"
            class="mx-[70px] mt-[30px] flex flex-col gap-5">
            @csrf
            <h2 class="text-2xl font-bold">Add New Student</h2>
            <div class="flex flex-col gap-[10px]">
                <p class="font-semibold">Email Address</p>
                <div
                    class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                    <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('assets') }}/images/icons/sms.svg" class="object-contain w-full h-full"
                            alt="icon">
                    </div>
                    <input type="text"
                        class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                        placeholder="Write student email address" name="email">
                </div>
            </div>
            <button type="submit"
                class="w-[500px] h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Add
                Student</button>
        </form>
    </div>
</x-app-layout>
