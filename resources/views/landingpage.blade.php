<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
    <nav class="bg-white mb-5">
        <div class="shadow px-20 xl:px-[240px] py-3 mx-auto">
            <div class="md:flex justify-between items-center">
                <!-- left section -->
                <div class="flex justify-between items-center">
                    <a href="">
                        <img src="{{asset('images/logo.svg')}}" alt="">
                    </a>
                    <div class="md:hidden">
                        <button id="nav-button" type="button" class="text-gray-500 hover:text-gray-600 focus:text-gray-600 focus:outline-none">
                            <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                <path d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                            </svg>  
                        </button>
                    </div>
                </div>
                <!-- right section -->
                <div id="nav-menu" class="flex flex-col mt-3 hidden md:flex-row md:mt-0 md:block">
                    <a href="#" class="text-orange-800 text-sm hover:font-medium md:mx-4 mt-3">Kelas</a>
                    <a href="#" class="text-gray-800 text-sm hover:font-medium md:mx-4 mt-3">Karya Alumni</a>
                    <a href="#" class="text-gray-800 text-sm hover:font-medium md:mx-4 mt-3">Kelas Saya</a>
                    <a href="#" class="md:mx-4 mt-3">
                        <img class="inline" src="{{asset('images/buy.svg')}}" alt=""> 
                    </a>
                    <a href="#" class="text-gray-800 text-sm hover:font-medium md:mx-4 mt-3 ">
                        <img class="inline" src="{{asset('images/avatar.svg')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="shadow px-20 py-3 mx-auto">
            <div class="md:flex items-center py-2 px-3 mx-auto">
                <div class="md:w-3/12 flex md:justify-center py-1">
                    <a href="" class="p-4 font-semibold text-xs bg-gray-300 text-gray-400 rounded-lg">
                        Mentify Bootcamp
                    </a>
                </div>
                <div class="md:w-3/12 flex md:justify-center py-1">
                    <a href="" class="p-4 font-semibold text-xs bg-gray-300 text-gray-400 rounded-lg">
                        Mentify Lite
                    </a>
                </div>
                <div class="md:w-3/12 flex md:justify-center py-1">
                    <a href="" class="p-4 font-semibold text-xs bg-[#9D1F64] text-white rounded-lg">
                        Online Workshop
                    </a>
                </div>
                <div class="md:w-3/12 flex md:justify-center py-1">
                    <a href="" class="p-4 font-semibold text-xs bg-gray-300 text-gray-400 rounded-lg">
                        Mentify Bootcamp
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="bg-white md:mt-5 mt-10">
        <div class="container px-10 mx-auto">
            <div class="md:flex items-center">
                <div class="md:w-5/12">
                    <h3 class="text-3xl font-bold">Online Workshop</h3>
                    <p class="mt-5 md:w-9/12 leading-relaxed">
                        Pelajari UX Writing dan kembangkan skillmu agar bisa membuat desain dengan copy yang mudah dimengerti.  Pada kelas UX Writing ini kamu akan belajar mengenai UX Writing lebih dalam dimulai dari fundamental hingga praktik di dunia kerja
                    </p>
                    <div class="mt-8">
                        <a href="" class=" p-4 text-sm bg-[#FF8E4E] text-black rounded-lg">
                            Pilihan Workshop
                        </a>
                    </div>
                </div>
                <div class="md:w-7/12 flex justify-center">
                    <img src="{{asset('images/hero1.svg')}}" width="636px" height="423px" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white md:mt-5 mt-10 mb-10">
        <div class="container px-10 mx-auto">
            <div class="md:flex items-center flex-wrap">
                <div class="md:w-9/12">
                    <h3 class="text-3xl font-bold">Berbagai Pilihan Workshop</h3>
                    <p class="mt-5 md:w-9/12 leading-relaxed">
                        Kami menyediakan berbagai pilihan workshop, kamu dapat memilih sesuai dengan keinginan kamu untuk mendalami ataupun mempelajari mengenai UX dan product design 
                        <b>sesuai keinginan dan kebutuhan kamu.</b> 
                    </p>
                </div>
                <div class="md:w-3/12 flex justify-center">
                    <form>
                        <div class="relative mb-4 sm:mt-10 flex w-full flex-wrap items-stretch">
                            <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                                <input
                                  type="search"
                                  name="search"
                                  value="{{(isset($_GET['search'])) ? $_GET['search'] : null}}"
                                  class="relative m-0 -mr-px block w-[1%] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-1.5 text-base font-normal text-neutral-700 outline-none transition duration-300 ease-in-out focus:border-primary-600 focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-300  dark:placeholder:text-neutral-200"
                                  placeholder="Search"
                                  aria-label="Search"
                                  aria-describedby="button-addon3" />
                                <button
                                  class="relative z-[2] rounded-r border border-solid px-6 py-2 dark:border-neutral-300 text-xs font-medium uppercase text-primary transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
                                  type="submit"
                                  id="button-addon3"
                                  data-te-ripple-init>
                                    <img src="{{asset('images/search.svg')}}" alt=""> 
                                </button>
                              </div>
                          </div>
                    </form>
                </div>
                <div class="w-full md:mt-5">
                    <div class="bg bg-[#EBD2E0] p-3 rounded-2xl md:rounded-full md:w-3/4">
                        Hai Evan, saat ini kamu memiliki kuota untuk  mengikuti 1 workshop secara gratis dari daftar workshop berikut 
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-10 mx-auto">
            <div class="flex items-center flex-wrap space-x-5 mt-3 md:mt-10">
                @foreach ($webinar_categories as $item)
                    @php
                        $active = "bg-gray-300 text-gray-400";
                        if(isset($_GET['webinar_category'])){
                            if ($_GET['webinar_category'] == $item->slug) {
                                $active = "bg-[#9D1F64] text-white";
                            }
                        }
                    @endphp
                    <div class="mt-10 md:mt-0">
                        <a href="?webinar_category={{$item->slug}}" class="py-4 px-8 font-semibold text-xs {{$active}} rounded-lg">
                            {{$item->name}}
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="container mt-10 px-10 mx-auto">
            <div class="flex flex-wrap justify-between">
                @forelse ($webinars as $item)
                    <div class="mb-10 xl:mr-5">
                        <div class="max-w-sm rounded-2xl overflow-hidden shadow-lg">
                            <div class="bg-[#9D1F64]">
                                <div class="pt-3 px-5">
                                    <img src="{{asset('images/logo2.svg')}}" alt="">
                                </div>
                                <div class="px-5 pt-8 pb-10 text-white font-bold">
                                    {{$item->title}}
                                </div>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex justify-between">
                                    <div class="flex mb-5 -space-x-4 -space-y-9">
                                        @foreach ($item->mentors as $mentor)
                                            <img class="w-10 -mt-9 h-10 border-2 border-white rounded-full" src="{{Storage::url($mentor->photo)}}" alt="">
                                        @endforeach
                                    </div>
                                    <div>
                                        <div class="bg-blue-500 -mt-9 text-xs font-semibold px-3 py-2 rounded-full text-white">
                                            {{$item->class_type}}
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-base mb-3">
                                    <b>Mentor</b>
                                    <br>
                                    {{implode(', ', $item->mentors?->pluck('name')->toArray())}}
                                </p>
                            <div>
                                @php
                                    $percentage = 0;
                                    if ($item->participants->count() > 0 && $item->quota > 0) {
                                        $percentage = ($item->participants->count() / $item->quota) * 100;
                                    }
                                    if($percentage < 100){
                                        if ($percentage > 50) {
                                            $text = 'Kouta terbatas akan segera habis';
                                        } else {
                                            $text = 'Kouta masih tersedia';
                                        }
                                        $colorText = 'text-[#F09819]';
                                        $colorBar = 'bg-gradient-to-r from-[#FF512F] to-[#F09819]';
                                        $helpText = 'Pendaftaran akan tutup dalam..';
                                    }else{
                                        $colorText = 'text-[#9D1F64]';
                                        $colorBar = 'bg-[#9D1F64]';
                                        $text = 'Wrokshop Penuh';
                                        $helpText = 'Sayang banget, workshop ini udah penuh kuotanya.';
                                    }
                                    
                                @endphp
                                <span class="font-bold mb-3 {{$colorText}}">{{$text}}</span>
                                    <div class="w-full h-4 bg-gray-200 rounded-full">
                                        <div class="h-full {{$colorBar}} rounded-full" style="width: {{$percentage}}%;"></div>
                                    </div>
                                <p class="mt-3 text-gray-500 text-xs">
                                    {{$helpText}}
                                </p>
                            </div>
                            @if ($percentage < 100)
                                <div class="p-5">
                                    <div class="py-2">
                                        <div class="bg bg-[#FF8E4E] py-3 px-5 text-md text-center font-semibold rounded-lg">
                                            Pelajari Workshop Lebih Lanjut
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center my-10 text-[#9D1F64] text-sm ">
                                    Lihat silabus yang diberikan di workshop ini
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                @empty
                Belum ada data
                @endforelse
            </div>
        </div>
    </div>
    <div class="bg-white mt-5 mb-10">
        <div class="container px-10 mx-auto">
            <div class="text-center text-3xl font-bold">
                4 Keuntungan dari Workshop Mentify
            </div>
            <div class="text-center mt-3 md:w-1/2 mx-auto">
                Workshop di mentify menawarkan berbagai keuntungan dibanding platform belajar lain, berikut beberapa keuntungan yang akan kamu dapatkan
            </div>
        </div>
        <div class="container px-10 mx-auto">
            <div class="md:flex mt-5">
                <div class="md:w-3/12 p-5">
                    <div
                      class="block max-w-sm rounded-lg bg-white h-[250px] p-6 shadow-lg ">
                      <div class="flex">
                          <img src="{{asset('images/icons/bx-caret-right-circle.svg')}}" class="inline mr-2" alt="">
                          <h5
                            class="mb-2 text-xl font-medium leading-tight text-neutral-800 flex items-center">
                            Recording Class
                          </h5>
                      </div>
                      <p class="py-5 text-sm text-gray-400 ">
                        Kamu akan mendapatkan recording class agar kamu dapat mengingat kembali materi dan diskusi yang terjadi di workshop kamu. 
                      </p>
                    </div>
                </div>
                <div class="md:w-3/12 p-5">
                    <div
                      class="block max-w-sm rounded-lg bg-white h-[250px] p-6 shadow-lg ">
                      <div class="flex">
                          <img src="{{asset('images/icons/bx-trophy.svg')}}" class="inline mr-2" alt="">
                          <h5
                            class="mb-2 text-xl font-medium leading-tight text-neutral-800 flex items-center">
                            e-certificate
                          </h5>
                      </div>
                      <p class="py-5 text-sm text-gray-400 ">
                        Workshop yang kamu ikuti akan memberikan e-certifikat yang dapat kamu publikiasikan ke portofolio maupun sosial media kamu. 
                      </p>
                    </div>
                </div>
                <div class="md:w-3/12 p-5">
                    <div
                      class="block max-w-sm rounded-lg bg-white h-[250px] p-6 shadow-lg ">
                      <div class="flex">
                          <img src="{{asset('images/icons/bx-bar-chart-alt-2.svg')}}" class="inline mr-2" alt="">
                          <h5
                            class="mb-2 text-xl font-medium leading-tight text-neutral-800 flex items-center">
                            Materi Workshop
                          </h5>
                      </div>
                      <p class="py-5 text-sm text-gray-400 ">
                        Materi Workshop dalam bentuk PPT / PDF akan kami berikan agar kamu dfapat kembali mempelajari materi lebih lanjut. 
                      </p>
                    </div>
                </div>
                <div class="md:w-3/12 p-5">
                    <div
                      class="block max-w-sm rounded-lg bg-white h-[250px] p-6 shadow-lg ">
                      <div class="flex">
                          <img src="{{asset('images/icons/bx-award.svg')}}" class="inline mr-2" alt="">
                          <h5
                            class="mb-2 text-xl font-medium leading-tight text-neutral-800 flex items-center">
                            Interactive Live Session with Expert
                          </h5>
                      </div>
                      <p class="py-5 text-sm text-gray-400 ">
                        Kamu berkesempatan langsung untuk berinteraksi dengan Expert dalam meningkatkan skill dan knowledge kamu.
                      </p>
                    </div>
                </div>
              </div>
        </div>
    </div>
    <div class="bg-white mt-5 mb-10">
        <div class="container px-10 mx-auto">
            <div class="text-center text-3xl font-bold">
                Apa Kata <span class="text-[#9D1F64]">Mereka</span> yang pernah berpartisipasi?
            </div>
        </div>
        <div class="container px-10 mx-auto">
            <div
                id="carouselExampleCaptions"
                class="relative"
                data-te-carousel-init
                data-te-carousel-slide>
                <div
                    class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
                    <div
                    class="relative float-left -mr-[100%] hidden w-full text-center transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                    data-te-carousel-active
                    data-te-carousel-item
                    style="backface-visibility: hidden">
                    <p
                        class="mx-auto max-w-4xl text-xl italic text-neutral-700 dark:text-neutral-300">
                        "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit,
                        error amet numquam iure provident voluptate esse quasi, voluptas
                        nostrum quisquam!"
                    </p>
                    <div class="mt-12 mb-6 flex justify-center">
                        <img
                        src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(2).webp"
                        class="h-24 w-24 rounded-full shadow-lg dark:shadow-black/30"
                        alt="smaple image" />
                    </div>
                    <p class="text-neutral-500 dark:text-neutral-300">- Anna Morian</p>
                    </div>
                    <div
                    class="relative float-left -mr-[100%] hidden w-full text-center transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                    data-te-carousel-item
                    style="backface-visibility: hidden">
                    <p
                        class="mx-auto max-w-4xl text-xl italic text-neutral-700 dark:text-neutral-300">
                        "Neque cupiditate assumenda in maiores repudiandae mollitia
                        adipisci maiores repudiandae mollitia consectetur adipisicing
                        architecto elit sed adipiscing elit."
                    </p>
                    <div class="mt-12 mb-6 flex justify-center">
                        <img
                        src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(31).webp"
                        class="h-24 w-24 rounded-full shadow-lg dark:shadow-black/30"
                        alt="smaple image" />
                    </div>
                    <p class="text-neutral-500 dark:text-neutral-300">- Teresa May</p>
                    </div>
                    <div
                    class="relative float-left -mr-[100%] hidden w-full text-center transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                    data-te-carousel-item
                    style="backface-visibility: hidden">
                    <p
                        class="mx-auto max-w-4xl text-xl italic text-neutral-700 dark:text-neutral-300">
                        "Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur est laborum neque
                        cupiditate assumenda in maiores."
                    </p>
                    <div class="mt-12 mb-6 flex justify-center">
                        <img
                        src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                        class="h-24 w-24 rounded-full shadow-lg dark:shadow-black/30"
                        alt="smaple image" />
                    </div>
                    <p class="text-neutral-500 dark:text-neutral-300">- Kate Allise</p>
                    </div>
                </div>
                <button
                    class="absolute top-0 bottom-0 left-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-black opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-black hover:no-underline hover:opacity-90 hover:outline-none focus:text-black focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none dark:text-white dark:opacity-50 dark:hover:text-white dark:focus:text-white"
                    type="button"
                    data-te-target="#carouselExampleCaptions"
                    data-te-slide="prev">
                    <span class="inline-block h-8 w-8">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    </span>
                    <span
                    class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
                    >Previous</span
                    >
                </button>
                <button
                    class="absolute top-0 bottom-0 right-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-black opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-black hover:no-underline hover:opacity-90 hover:outline-none focus:text-black focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none dark:text-white dark:opacity-50 dark:hover:text-white dark:focus:text-white"
                    type="button"
                    data-te-target="#carouselExampleCaptions"
                    data-te-slide="next">
                    <span class="inline-block h-8 w-8">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    </span>
                    <span
                    class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
                    >Next</span
                    >
                </button>
                </div>
        </div>
    </div>
    <div class="bg-[##FAFAFA] mt-5 mb-10">
        <div class="container px-10 mx-auto">
            <footer
            class="md:text-center text-neutral-600  lg:text-left">
            <div class="mx-6 py-10 md:text-left">
                <div class="md:flex">
                <div class="md:w-4/12">
                    <img src="{{asset('images/footer/logo.svg')}}" alt="">
                    <p class="text-gray-500 mt-5 mb-5">
                        Copyright © 2021 Mentify by Giza Lab
                    </p>
                </div>
                <div class="md:w-3/12">
                    <h6
                    class="mb-4 md:flex justify-center  md:justify-start">
                    Sitemap
                    </h6>
                    <p class="mb-4">
                    <a href="#!" class="text-gray-400 text-sm font-semibold"
                        >Bootcamp</a
                    >
                    </p>
                    <p class="mb-4">
                    <a href="#!" class="text-gray-400 text-sm font-semibold"
                        >Mentify Lite</a
                    >
                    </p>
                    <p class="mb-4">
                    <a href="#!" class="text-gray-400 text-sm font-semibold"
                        >Karya Alumni</a
                    >
                    </p>
                    <p>
                    <a href="#!" class="text-gray-400 text-sm font-semibold"
                        >Kelas Saya</a
                    >
                    </p>
                </div>
                <div class="md:w-3/12 mt-5 md:mt-0">
                    <h6
                    class="mb-4 md:flex justify-center  md:justify-start">
                    About
                    </h6>
                    <p class="mb-4">
                    <a href="#!" class="text-gray-400 text-sm font-semibold"
                        >About Us</a
                    >
                    </p>
                    <p class="mb-4">
                    <a href="#!" class="text-gray-400 text-sm font-semibold"
                        >Our Team</a
                    >
                    </p>
                    <p class="mb-4">
                    <a href="#!" class="text-gray-400 text-sm font-semibold"
                        >Contact Us</a
                    >
                    </p>
                    <p>
                    <a href="#!" class="text-gray-400 text-sm font-semibold"
                        >FAQ</a
                    >
                    </p>
                </div>
                <div class="md:w-2/12 mt-5 md:mt-0">
                    <h6
                    class="mb-4 md:flex justify-center  md:justify-start">
                    Get  in Touch
                </h6>
                <div class="flex space-x-5">
                    <img src="{{asset('images/footer/instagram.svg')}}" alt="">
                    <img src="{{asset('images/footer/linkedin.svg')}}" alt="">
                </div>
                </div>
                </div>
            </div>
            </footer>
        </div>
    </div>
    <script>
        let button = document.getElementById('nav-button');
        let menu = document.getElementById('nav-menu');

        button.addEventListener('click', () => {
            menu.classList.toggle("hidden");
        });
    </script>
</body>
</html>