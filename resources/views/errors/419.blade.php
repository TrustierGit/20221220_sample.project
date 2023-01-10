<x-guest-layout>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center mb-12">
                <div id ="error_title" class="font-bold text-4xl py-12">419 Page Expired</div>

                <div class="font-bold text-2xl p-12">再度ログインを行ってください。
                </div>
                <div class="p-2 w-full">
                    <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" onclick="location.href='{{ route('login') }}' ">トップページに戻る</button>
                </div>
            </div>
        </div>

    </section>
</x-guest-layout>