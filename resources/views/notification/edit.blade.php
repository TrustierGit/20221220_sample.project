<x-guest-layout>
  <section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-wrap -m-4 ml-12">
        <div class="p-4 md:w-1/3">
          <h2 class="font-bold text-3xl pb-12">■更新投稿ページ</h2>
              <form class="form-horizontal" method="POST" action=/admin/notification_edit/{id}>
                @csrf
              <input type="hidden" name="id" value="{{$notification->id}}">
                  <div class="relative mb-4">
                  <label for="date_post" class="leading-7 text-lg text-gray-600">日付</label>
                      <input id="date" type="date" class="form-control" name="date_post" value="{{$notification->date_post}}" required>
                  </div>
                  <div class="relative mb-4">
                  <label for="text_title" class="leading-7 text-lg text-gray-600">区分</label>
                            <select id="text_title" name="text_title" value="{{$notification->text_title}}" required>
                              <option>Info</option>
                              <option>Err</option>
                            </select>  
                  </div>
                <div class="relative mb-4">
                        <p><label for="text_message" class="col-md-4 control-label leading-7 text-lg text-gray-600">投稿メッセージ</label></p>
                        <textarea id="text_message" type="text" class="form-control" name="text_message" required>{{$notification->text_message}}</textarea>
                </div>
                <button class="mt-8 mb-8 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" action=/admin/notification_new>更新</button>
              </form>
            <button class="text-white bg-yellow-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg" onclick="location.href='{{ route('notification.create') }}' ">戻る</button>
        </div>
      </div>
    </div>
  </section>
</x-guest-layout>







