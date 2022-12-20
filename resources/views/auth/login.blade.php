<x-guest-layout>
    <x-auth-card>
        <x-slot name="title">
            <div iv class="text-3xl mb-6 mt-10 px-10 py-10 bg-indigo-800 text-white rounded font-bold">テレワーク利用予約システム</div>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4"  :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <form method="POST" action="{{ route('login') }}">
              @csrf

              <!-- Email Address -->
              <div>
                  <x-input-label for="email" :value="__('メールアドレス')" />

                  <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
              </div>

              <!-- Password -->
              <div class="mt-4">
                  <x-input-label for="password" :value="__('パスワード')" />

                  <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
              </div>
              <!-- Remember Me -->
              <div class="block mt-4">
                  <label for="remember_me" class="inline-flex items-center">
                      <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                      <span class="ml-2 text-sm text-gray-600">{{ __('ログイン情報を保持する') }}</span>
                  </label>
              </div>

              <div class="flex items-center justify-end mt-4">

                  <x-primary-button class="ml-3">
                      {{ __('ログイン') }}
                  </x-primary-button>             
              </div>
          </form>
    </x-auth-card>
    <div class="flex items-center text-2xl mb-12 place-content-center">パスワードをお忘れの方はシステム管理者へご連絡ください</div>
   @if($if_exist)
   <div class="container px-10 py-8 mx-auto bg-white border-4 bg-white-100">
        <div class="flex items-center text-3xl mb-4 place-content-center font-bold">―　お知らせ　―</div>
              
                  <div class="overflow-y-auto h-52">
                      <div class="flex flex-col text-center w-full mb-4">
                            <div class="w-full mx-auto overflow-auto">
                            <table style="table-layout:fixed; width:100%;" class="table-auto w-full text-center font-bold text-xlwhitespace-no-wrap border-solid border-collapse">
                                <colgroup>
                                    <col style="width:15%;">
                                    <col style="width:15%;">
                                    <col style="width:70%;">
                                </colgroup>
                                <thead>
                                  <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-black text-lg bg-gray-300 border border-slate-500">日付</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-black text-xl bg-gray-300 border border-slate-500">区分</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-black text-lg bg-gray-300 border border-slate-500 max-w-[50%]">メッセージ</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($notifications as $notification)
                                  <tr>
                                    <td class="px-4 py-3 border border-slate-400">{{$notification->date_post}}</td>
                                    <td class="px-4 py-3 border border-slate-400 bg-white ">
                                        @if($notification->text_title === 'Info')
                                            <span class="bg-green-700 text-white px-3 py-2 rounded">お知らせ</span>
                                            @else
                                            <span class="bg-red-700 text-white p-2 rounded">障害情報</span>
                                        @endif
                                    </td>
                                    <td style="word-wrap:break-word;" class="px-4 py-3 border border-slate-400 text-left">{!!nl2br(e($notification->text_message))!!}</td>
                                  </tr>
                                @endforeach
                                {{$notifications}}
                                </tbody>
                              </table>
                            </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    @endif
</x-guest-layout>
