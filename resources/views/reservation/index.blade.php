<x-app-layout>

<div  x-data="{ open: false }">

<div id="example">
    <p></p>
</div>
  <div class="container px-8 py-8 mx-auto">
    <div class="block">
        <h1 class="text-2xl font-medium title-font text-gray-900 py-8 float-left">■利用予約</h1>
        
    <!-- Tips Dropdown -->
    <div class="hidden sm:flex sm:items-center sm:ml-6 py-8 float-right">
                <x-dropdown align="right" width="96">
                    <x-slot name="trigger">
                    <button class="flex items-center font-semibold text-white hover:text-gray-700 hover:border-gray-200 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150">
                    <div class="w-28 h-10 inline-flex items-center justify-center bg-green-500 text-gray-900 mb-0 font-bold rounded-lg">
                        Tips Menu
                    </div>
                    </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="font-bold text-lg p-4"> 
                            <ul class="list-disc pl-8">
                            <li>カレンダー表示色</li>
                                <div class="border-2 border-gray-300">
                                    <div class ="pl-4 py-2"><span class="reserved_ticket px-1 py-2">緑色</span>・・・予約済み</div>
                                    <div class ="pl-4 py-2"><span class="is_reserved px-1 py-2">赤色</span>・・・予約不可</div>
                                </div>
                                <div class="py-4">
                            <li>予約方法</li>
                                <div class ="pl-4">予約／キャンセルしたい日付をクリック</div>
                            </div>
                            </ul>
                        </div>
                    </x-slot>
                </x-dropdown>
        </div>
        </div>
    
    {{-- フラッシュメッセージの表示 --}}
    <script src="{{ asset('js/jquery.min2.js')}}"></script>
    <script src="{{ asset('js/toastr.min.js')}}"></script>
    <script src="{{ asset('js/toastr.js')}}"></script>
        <script>
            @if (session('status'))
                $(function () {
                        toastr.success('{{ session('status') }}');
                });
            @endif
        </script>
    {{-- 時間外表示 --}}
    @if($calendar->flag_open === false)
        <div class="pt-32 pl-32">
            <div class="text-xl bg-white p-4 text-center font-bold">
                ただいま利用時間外のため、利用予約機能を停止しております。<br>
                利用時間は{!! config('maintenance.open_from')!!}～{!! config('maintenance.open_to')!!}です。<br>
                ご不便をおかけ致しますが、利用時間内にご利用くださいますようお願い申し上げます。
            </div>
        </div>
    @endif
        
    <!-- 2023-01-10 変更 <div class="p-4 border-b border-gray-200 flex flex-auto"> -->
    <!-- <div class="p-4 border-b border-gray-200 block"> -->
   
        <!-- 2023-01-10 変更 <div class="px-12 py-24 text-2xl"> -->
        <!-- <div class="px-12 py-24 text-2xl left" style="float:left;"> -->
        <div class="px-12 py-24 text-2xl flex flex-auto">
            <div class="block ml-6 mr-6">
                <div class="title-font font-medium text-gray-900 mb-3 text-3xl table">{{ $calendar->getTitle() }}</div>
                <div class="calendar">{!! $calendar->render(0) !!}</div>
            </div>
        <!-- </div> -->
        <!-- 2023-01-10 変更 <div class="px-12 py-24 text-2xl"> -->
        <!-- <div class="px-12 py-24 text-2xl left" style="float:left;"> -->
        <!-- <div class="px-12 py-24 text-2xl flex flex-auto"> -->
            <div class="block ml-6 mr-6">
                <div class="title-font font-medium text-gray-900 mb-3 text-3xl table">{{ $calendar->getTitle(config('cal.next_month')) }}</div>
                <div class="calendar">{!! $next_calendar->render(config('cal.next_month')) !!}</div>
            </div>
        </div>

          <!--modal-->
            <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true" >
                 <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open">
                        <div class="text-center bg-gray-100 h-auto p-8 md:max-w-xl md:p-12 lg:p-12 shadow-xl rounded-lg mx-2 md:mx-0" @click.away="open = false">
                                <div class="modal-dialog">
                                    <button id="close_btn" type="button" class="round_btn" data-dismiss="modal" aria-label="Close"></button>
                                        <div class="modal-content">
                                            <div class="modal-header mt-12 text-3xl font-bold"></div>
                                                <div class="modal-body">
                                                    <form method="POST" action=/user/reservation_list>
                                                                <div>
                                                                    @csrf
                                                                </div>
                                                                <div class="modal-title mt-8"><div>
                                                                    <input class="hidden-form1" name="rsvdate" id="rsvdate" value="" type="hidden">
                                                                    <input class="hidden-form2" name="email" id="email" value="" type="hidden">
                                                                </div>
                                                                
                                                            <button id="reserve" name="make_reservation" class="text-white bg-indigo-500 border-0 py-4 px-8 my-8 focus:outline-none hover:bg-indigo-600 rounded-lg text-2xl" action=/user/reservation_list  disabled=true>予約登録</button>
                                                            <button id="cancel" name="cancel" class="text-white bg-yellow-500 border-0 py-4 px-8 my-8 focus:outline-none hover:bg-yellow-600 rounded-lg text-2xl" action=/user/reservation_list disabled=true>予約取消</button>
                                                            
                                                    </form>
                                                </div>
                                        </div>
                                                
                                    <div class="modal-footer"></div>
                                </div>
                        </div>
                    </div>
                </div>
<!--Ajax-->
        <script src="{{ asset('js/vue.global.prod.js')}}"></script>
        <script src="{{ asset('js/jquery-3.5.1.slim.min.js')}}"></script>
        <script src="{{ asset('js/axios.min.js')}}"></script>
        <script src="{{ asset('js/luxon.min.js')}}"></script>
        <script src="{{ asset('js/popper.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/jquery.min.js')}}"></script>

        <script>
        $('#registerModal').hide();
        $(window).on('load',function(){
            $('#close_btn').on('click', function () {
                $('.modal-header').empty();
                $('.hidden-form1').val('');
                $('.hidden-form2').val('');
                $('button#reserve,button#cancel').prop('disabled',true);
                });
            $('.button-calender').on('click', function () {
                let rsvdate = this.dataset.value;
                $('.modal-header').empty();
                $('.hidden-form1').val('');
                $('.hidden-form2').val('');

                if (!rsvdate) {
                    return false;
                } 
                $.ajax({
                    type: 'GET',
                    url: '/user/ajax/'  , 
                    data: {
                    'days': rsvdate, 
                },
                    dataType: 'json', 
                    beforeSend: function () {
                        $('.loading').removeClass('display-none');
                    }
                }).done(function (data,status,xhr) { 
                    $.each(data, function (index, value) { 
                        let is_reserved = value.is_reserved;
                        $(function(){
                        $('.modal-header').append(value.days);
                            if(value.is_reserved === 1){
                            $('.modal-header').append('<div class="text-red-600 text-2xl font-bold">予約済み</div>');
                            $('button#cancel').prop('disabled',false);
                            } else {
                                if(value.counts < {{$calendar->getLicenseCount()}}){
                                    $('.modal-header').append('<div class="text-green-600 text-2xl font-bold">予約可能</div>');
                                    $('button#reserve').prop('disabled',false).addClass('availavle_cls');
                                } else {
                                    $('.modal-header').append('<div class="text-red-600 text-2xl font-bold">予約不可</div>');
                                }
                            }
                            $('.hidden-form1').val(value.days);
                            $('.hidden-form2').val(value.email);
                        });
                    })
                }).fail(function (data,status,xhr) {
                    console.log(data);
                    console.log(status);
                    console.log(xhr);
                });
            });
        });
        </script>
                </div>
            </div>
        </div>

</x-app-layout>
