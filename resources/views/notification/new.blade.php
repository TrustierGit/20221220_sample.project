<x-guest-layout>
<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
        <div class="font-bold text-3xl pb-12">■新規投稿ページ</div>
          <div class="flex w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0">
              <div class="lg:w-1/2 md:w-full mx-auto relative flex-grow w-full">
                <form class="form-horizontal" method="POST" action=/admin/notification_new>
                    @csrf 
                  <div class="relative mb-4">
                    <label for="date_post" class="leading-7 text-lg text-gray-600">日付</label>
                    <input id="date" type="date" class="form-control" name="date_post" required>
                  </div>
                  <div class="relative mb-4">
                    <label for="text_title" class="leading-7 text-lg text-gray-600">区分</label>
                    <select id="text_title" name="text_title" required>
                      <option>Info</option>
                      <option>Err</option>
                    </select>  
                  </div>
                  <div class="relative mb-4">
                  <p><label for="text_message" class="leading-7 text-lg text-gray-600">投稿メッセージ</label></p>
                    <textarea id="text_message" type="text" class="form-control" name="text_message" required></textarea>
                  </div>
                  <button class="mt-8 mb-8 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" action=/admin/notification_new>登録</button>
                </form>
                <button class="text-white bg-yellow-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg" onclick="location.href='{{ route('notification.create') }}' ">戻る</button>
              </div>
          </div>
        </div>
      </div>
</section>
</x-guest-layout>
 