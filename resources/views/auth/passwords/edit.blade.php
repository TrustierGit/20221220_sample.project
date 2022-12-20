<x-app-layout>
<div class="container px-5 py-4 mx-auto">
    <h1 class="text-2xl font-medium title-font text-gray-900 py-12">■パスワード変更</h1>
      
      <div class="p-6 text-left pl-24 bg-white border-2 border-gray-400 rounded">
        <div class="text-2xl text-gray-800 mb-4"><strong>パスワードポリシー</strong></div>
          <div class ="text-xl">
                <ul class="list-disc pl-12">
                    <li>8文字～16文字以内<span class="text-red-600 font-bold">(必須)</span></li>
                    <li>大文字及び小文字を含む、英数字1文字以上<span class="text-red-600 font-bold">(必須)</span></li>
                    <li>記号<span class="font-bold">(任意)</span> <br> <span class="pl-8">使用可能記号　!"#$%&'() </span></li>
                </ul>
            </p>
          </div>
    </div>
</div>
    <div class="panel-body">
                    {{-- フラッシュメッセージの表示 --}}
                    @if (session('warning'))
                        <div class="alert alert-warning">
                        <div class="text-2xl font-medium text-red-900 mb-8 text-center">{{ session('warning') }}</div>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-info">
                        <div class="text-2xl font-medium text-blue-900 mb-8 text-center">{{ session('status') }}</div>
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('password.change') }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
 
    <div class="flex w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end py-8 text-lg font-bold">
    <div style="width: 15%;" class="lg:w-1/2 md:w-1/2 mx-auto">
      <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">

        <label for="current_password" class="control-label rounded" >現在のパスワード</label>
        <input id="current_password" type="password" class="form-control" name="current_password" required>
      </div>
        @if ($errors->has('current_password'))
                                    <span class="help-block">
                                    <div class="font-medium text-red-900 mb-6">{{ $errors->first('current_password') }}</div>
                                    </span>
        @endif

    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}"> 
      <div class="relative flex-grow w-full">
        <label for="new_password" class="col-md-4 control-label rounded">新しいパスワード</label>
        <input id="new_password" type="password" class="form-control " name="new_password" required>
        @if ($errors->has('new_password'))
                                    <span class="help-block">
                                    <div class="font-medium text-red-900 mb-6">{{ $errors->first('new_password') }}</div>
                                    </span>
        @endif
      </div>
      <div class="relative flex-grow w-full">
      <label for="new_password-confirm" class="col-md-4 control-label rounded">パスワード再入力</label>
      <input id="new_password-confirm" type="password" class="form-control " name="new_password_confirmation" required>
 
        @if ($errors->has('new_password_confirmation'))
            <span class="help-block">
            <div class="font-medium text-red-900 mb-6">{{ $errors->first('new_password_confirmation') }}</div>
            </span>
        @endif
      </div>
      <div class="px-5 py-8 mx-auto">
      <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">パスワード変更</button>
      </div>
      </div>
    </div>
  </div>
</section>
</x-app-layout>


