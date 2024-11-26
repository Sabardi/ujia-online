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
                <div class="flex gap-3 items-center">
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
                    class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage
                    Courses</a>
                <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Course
                    Students</a>
            </div>
        </div>
        <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
            <div class="flex gap-6 items-center">
                <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                    <img src="{{ Storage::url($course->cover) }}" class="w-full h-full object-contain" alt="icon">
                    <p
                        class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap">
                        {{ $course->category->name }}</p>
                </div>
                <div class="flex flex-col gap-5">
                    <h1 class="font-extrabold text-[30px] leading-[45px]">{{ $course->name }}</h1>
                    <div class="flex items-center gap-5">
                        <div class="flex gap-[10px] items-center">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets') }}/images/icons/calendar-add.svg" alt="icon">
                            </div>
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($course->created_at)->format('F j, Y') }}</p>
                        </div>
                        <div class="flex gap-[10px] items-center">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets') }}/images/icons/profile-2user-outline.svg" alt="icon">
                            </div>
                            <p class="font-semibold">{{ $course->students->count() }} students</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <a href="{{ route('dashboard.course.course.student.create', $course->id) }}"
                    class="h-[52px] p-[14px_30px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D]">Add
                    Student</a>
            </div>
        </div>
        <div id="course-test" class="mx-[70px] w-[870px] mt-[30px]">
            <h2 class="font-bold text-2xl">Students</h2>
            <div class="flex flex-col gap-5 mt-2">
                @forelse ($students as $student)
                    <div
                        class="student-card w-full flex items-center justify-between p-4 border border-[#EEEEEE] rounded-[20px]">
                        <div class="flex gap-4 items-center">
                            <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                <img src="{{ asset('assets') }}/images/photos/default-photo.svg"
                                    class="w-full h-full object-cover" alt="photo">
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <p class="font-bold text-lg">{{ $student->name }}</p>
                                <p class="text-[#7F8190]">{{ $student->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-[14px]">
                            {{ $student->status }}
                            {{-- @if ($student->status == 'passed')
                                <p
                                    class="p-1.5 rounded-lg bg-green-600 font-bold text-xs text-white outline-green-600 outline-dashed outline-2 outline-offset-1 mr-1.5">
                                    Passed
                                </p>
                            @elseif ($student->status == 'Not Started')
                                <p
                                    class="p-1.5 rounded-lg bg-black font-bold text-xs text-black outline-purple-500 outline-dashed outline-2 outline-offset-1 mr-1.5">
                                    Not Started
                                </p>
                            @elseif ($student->status == 'not passed')
                                <p
                                    class="p-1.5 rounded-lg bg-red-600 font-bold text-xs text-white outline-red-600 outline-dashed outline-2 outline-offset-1 mr-1.5">
                                    Not Passed
                                </p>
                            @endif --}}
                        </div>
                    </div>
                @empty
                    <p>No Students</p>
                @endforelse
            </div>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuButton = document.getElementById('more-button');
                const dropdownMenu = document.querySelector('.dropdown-menu');

                menuButton.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');
                });

                // Close the dropdown menu when clicking outside of it
                document.addEventListener('click', function(event) {
                    const isClickInside = menuButton.contains(event.target) || dropdownMenu.contains(event
                        .target);
                    if (!isClickInside) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
