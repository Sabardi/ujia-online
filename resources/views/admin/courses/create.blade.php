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
                        <p class="text-sm text-[#7F8190]">{{ Auth::user()->roles->first()->name }}</p>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
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
                <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">New Course</a>
            </div>
        </div>
        <div class="flex flex-col gap-1 px-5 mt-5 header">
            <h1 class="font-extrabold text-[30px] leading-[45px]">New Course</h1>
            <p class="text-[#7F8190]">Provide high quality for best students</p>
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

        <form action="{{ route('dashboard.courses.store') }}" method="post" enctype="multipart/form-data"
            class="flex flex-col gap-[30px] w-[500px] mx-[70px] mt-10">
            @csrf
            <div class="flex items-center gap-5">
                <input type="file" name="cover" id="icon" class="hidden peer" onchange="previewFile()"
                    data-empty="true" required>
                <div
                    class="relative w-[100px] h-[100px] rounded-full overflow-hidden peer-data-[empty=true]:border-[3px] peer-data-[empty=true]:border-dashed peer-data-[empty=true]:border-[#EEEEEE]">
                    <div class="relative z-10 hidden w-full h-full file-preview">
                        <img src="" class="object-cover w-full h-full thumbnail-icon" alt="thumbnail">
                    </div>
                    <span
                        class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 text-center font-semibold text-sm text-[#7F8190]">Icon
                        <br>Course</span>
                </div>
                <button type="button"
                    class="flex shrink-0 p-[8px_20px] h-fit items-center rounded-full bg-[#0A090B] font-semibold text-white"
                    onclick="document.getElementById('icon').click()">
                    Add Icon
                </button>
            </div>
            <div class="flex flex-col gap-[10px]">
                <p class="font-semibold">Course Name</p>
                <div
                    class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                    <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('assets') }}/images/icons/note-favorite-outline.svg"
                            class="object-contain w-full h-full" alt="icon">
                    </div>
                    <input type="text"
                        class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                        placeholder="Write your better course name" name="name" required>
                </div>
            </div>
            <div class="group/category flex flex-col gap-[10px]">
                <p class="font-semibold">Category</p>
                <div
                    class="peer flex items-center p-[12px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                    <div class="mr-[10px] w-6 h-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('assets') }}/images/icons/bill.svg" class="object-contain w-full h-full"
                            alt="icon">
                    </div>
                    <select id="category"
                        class="pl-1 font-semibold focus:outline-none w-full text-[#0A090B] invalid:text-[#7F8190] invalid:font-normal appearance-none bg-[url('{{ asset('assets') }}/images/icons/arrow-down.svg')] bg-no-repeat bg-right"
                        name="category_id" required>
                        <option value="" disabled selected hidden>Choose one of category</option>
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                            <option value="">category is not found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="flex flex-col gap-[10px]">
                <p class="font-semibold">Course Type</p>
                <div class="flex items-center gap-5">
                    <a href="#"
                        class="group relative flex flex-col w-full items-center gap-5 p-[30px_16px] border border-[#EEEEEE] rounded-[30px] transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B]"
                        data-group="course-type" aria-checked="false" onclick="handleActiveAnchor(this)">
                        <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden">
                            <img src="{{ asset('assets') }}/images/icons/onboarding.svg" class="w-full h-full"
                                alt="icon">
                        </div>
                        <span class="mx-auto font-semibold text-center">Onboarding</span>
                        <div
                            class="absolute transform -translate-x-1/2 -translate-y-1/2 top-[24px] right-0 hidden transition-all duration-300 group-aria-checked:block">
                            <img src="{{ asset('assets') }}/images/icons/tick-circle.svg" alt="icon">
                        </div>
                    </a>
                    <a href="#"
                        class="group relative flex flex-col w-full items-center gap-5 p-[30px_16px] border border-[#EEEEEE] rounded-[30px] transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B]"
                        data-group="course-type" aria-checked="false" onclick="handleActiveAnchor(this)">
                        <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden">
                            <img src="{{ asset('assets') }}/images/icons/module.svg" class="w-full h-full"
                                alt="icon">
                        </div>
                        <span class="mx-auto font-semibold text-center">CBT Module</span>
                        <div
                            class="absolute transform -translate-x-1/2 -translate-y-1/2 top-[24px] right-0 hidden transition-all duration-300 group-aria-checked:block">
                            <img src="{{ asset('assets') }}/images/icons/tick-circle.svg" alt="icon">
                        </div>
                    </a>
                    <a href="#"
                        class="group relative flex flex-col w-full items-center gap-5 p-[30px_16px] border border-[#EEEEEE] rounded-[30px] transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B]"
                        data-group="course-type" aria-checked="false" onclick="handleActiveAnchor(this)">
                        <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden">
                            <img src="{{ asset('assets') }}/images/icons/job.svg" class="w-full h-full"
                                alt="icon">
                        </div>
                        <span class="mx-auto font-semibold text-center">Job-Ready</span>
                        <div
                            class="absolute transform -translate-x-1/2 -translate-y-1/2 top-[24px] right-0 hidden transition-all duration-300 group-aria-checked:block">
                            <img src="{{ asset('assets') }}/images/icons/tick-circle.svg" alt="icon">
                        </div>
                    </a>
                </div>
            </div>
            <div class="flex flex-col gap-[10px]">
                <p class="font-semibold">Publish Date</p>
                <div class="flex gap-[10px] items-center">
                    <a href="#"
                        class="group relative flex w-full items-center gap-[14px] p-[14px_16px] border border-[#EEEEEE] rounded-full transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B]"
                        data-group="publish-date" aria-checked="false" onclick="handleActiveAnchor(this)">
                        <div class="w-[24px] h-[24px] flex shrink-0 overflow-hidden">
                            <img src="{{ asset('assets') }}/images/icons/clock.svg" class="w-full h-full"
                                alt="icon">
                        </div>
                        <span class="font-semibold">Active Now</span>
                        <div
                            class="absolute right-0 hidden transition-all duration-300 transform -translate-x-1/2 -translate-y-1/2 top-1/2 group-aria-checked:block">
                            <img src="{{ asset('assets') }}/images/icons/tick-circle.svg" alt="icon">
                        </div>
                    </a>
                    <a href="#"
                        class="group relative flex w-full items-center gap-[14px] p-[14px_16px] border border-[#EEEEEE] rounded-full transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B] disabled:border-[#EEEEEE]"
                        data-group="publish-date" aria-checked="false" onclick="event.preventDefault()" disabled>
                        <div class="w-[24px] h-[24px] flex shrink-0 overflow-hidden">
                            <img src="{{ asset('assets') }}/images/icons/calendar-add-disabled.svg"
                                class="w-full h-full" alt="icon">
                        </div>
                        <span class="font-semibold text-[#EEEEEE]">Schedule for Later</span>
                        <div
                            class="absolute right-0 hidden transition-all duration-300 transform -translate-x-1/2 -translate-y-1/2 top-1/2 group-aria-checked:block">
                            <img src="{{ asset('assets') }}/images/icons/tick-circle.svg" alt="icon">
                        </div>
                    </a>
                </div>
            </div>
            <div class="group/access flex flex-col gap-[10px]">
                <p class="font-semibold">Access Type</p>
                <div
                    class="peer flex items-center p-[12px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                    <div class="mr-[10px] w-6 h-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('assets') }}/images/icons/security-user.svg"
                            class="object-contain w-full h-full" alt="icon">
                    </div>
                    <select id="access"
                        class="pl-1 font-semibold focus:outline-none w-full text-[#0A090B] invalid:text-[#7F8190] invalid:font-normal appearance-none bg-[url('{{ asset('assets') }}/images/icons/arrow-down.svg')] bg-no-repeat bg-right"
                        name="access" required>
                        <option value="" disabled selected hidden>Choose the access type</option>
                        <option value="invitation_only" class="font-semibold">Invitation Only</option>
                    </select>
                </div>
            </div>
            <label class="font-semibold flex items-center gap-[10px]"><input type="radio" name="tnc"
                    class="w-[24px] h-[24px] appearance-none checked:border-[3px] checked:border-solid checked:border-white rounded-full checked:bg-[#2B82FE] ring ring-[#EEEEEE]"
                    checked />
                I have read terms and conditions
            </label>
            <div class="flex items-center gap-5">
                <a href=""
                    class="w-full h-[52px] p-[14px_20px] bg-[#0A090B] rounded-full font-semibold text-white transition-all duration-300 text-center">Add
                    to Draft</a>
                <button type="submit"
                    class="w-full h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Save
                    Course</button>
            </div>
        </form>
    </div>

    @push('script')
        <script>
            function previewFile() {
                var preview = document.querySelector('.file-preview');
                var fileInput = document.querySelector('input[type=file]');

                if (fileInput.files.length > 0) {
                    var reader = new FileReader();
                    var file = fileInput.files[0]; // Get the first file from the input

                    reader.onloadend = function() {
                        var img = preview.querySelector('.thumbnail-icon'); // Get the thumbnail image element
                        img.src = reader.result; // Update src attribute with the uploaded file
                        preview.classList.remove('hidden'); // Remove the 'hidden' class to display the preview
                    }

                    reader.readAsDataURL(file);
                    fileInput.setAttribute('data-empty', 'false');
                } else {
                    preview.classList.add('hidden'); // Hide preview if no file selected
                    fileInput.setAttribute('data-empty', 'true');
                }
            }
        </script>

        <script>
            function handleActiveAnchor(element) {
                event.preventDefault();

                const group = element.getAttribute('data-group');

                // Reset all elements' aria-checked to "false" within the same data-group
                const allElements = document.querySelectorAll(`[data-group="${group}"][aria-checked="true"]`);
                allElements.forEach(el => {
                    el.setAttribute('aria-checked', 'false');
                });

                // Set the clicked element's aria-checked to "true"
                element.setAttribute('aria-checked', 'true');
            }
        </script>
    @endpush
</x-app-layout>
