<x-guest-layout>
  <section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-wrap -m-4 ml-12">
        <div class="p-4 md:w-1/3">
          <h2 class="font-bold text-3xl pb-12">■削除ページ</h2>
            <form class="form-horizontal" method="POST" action=/admin/notification_delete/{id}>
              @csrf
            <input type="hidden" name="id" value="{{$notification->id}}">
              <div class="relative mb-4">
                <label for="name" class="leading-7 text-lg text-gray-600">日付</label>
                <div class="border border-slate-800 bg-white py-1 px-3 leading-8">{{$notification->date_post}}</div>
              </div>
              <div class="relative mb-4">
                <label for="name" class="leading-7 text-lg text-gray-600">区分</label>
                <div class="border border-slate-800 bg-white py-1 px-3 leading-8">{{$notification->text_title}}</div>
              </div>
              <div class="relative mb-4">
                <label for="name" class="leading-7 text-lg text-gray-600">メッセージ</label>
                <div class="border border-slate-800 bg-white py-1 px-3 leading-8 overflow-auto">{{$notification->text_message}}</div>
              </div>
              <button class="mb-8 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" action=/admin/notification_new>削除</button>
            </form>
          <button class="text-white bg-yellow-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg" onclick="location.href='{{ route('notification.create') }}' ">戻る</button>
        </div>
      </div>
    </div>
  </section>
</x-guest-layout>