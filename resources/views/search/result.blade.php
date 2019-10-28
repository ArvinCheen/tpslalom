@extends('layout')

@section('css')

@endsection

@section('content')
{{--    <section class="bg-image bg-image-sm" style="background-image: url({{ URL::asset('front/comingSoon.jpg') }});">--}}
{{--        <div class="overlay"></div>--}}
{{--        <div class="coming-soon p-y-80">--}}
{{--            <div>--}}
{{--                <h2> 即將開放！！ </h2>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}





    <div class="mh mb-5">
        <div class="container">
            <div class="mt-5 mb-5 text-center">
                <h2> 成績查詢 </h2>
            </div>
            <div class="col-md-12">
                <select class="form-control" id="m_select2_1" name="scheduleSn">
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }} - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組  {{ $schedule->item }} {{ $schedule->game_type }} {{ $schedule->remark }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="20">
                            @if (is_null($openResultTime))
                                成績公告時間：尚未公告
                            @else
                                成績公告時間：{{ $openResultTime }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center"> 名次 </th>
                        <th class="text-center"> 編號 </th>
                        <th class="text-center"> 選手 </th>
                        @if ($scheduleId >= 24 || ($scheduleId >= 11 && $scheduleId <= 20 ))
                            @if ($scheduleId >= 24 || $scheduleId <= 34)
                                @if ($scheduleId == 27 || $scheduleId >= 35)
                                    <th class="text-center"> 一回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 二回 </th>
                                    <th class="text-center"> 誤椿 </th>
                                    <th class="text-center"> 成績 </th>
                                @else
{{--                                    <th class="text-center"> 一回 </th>--}}
{{--                                    <th class="text-center"> 誤椿 </th>--}}
{{--                                    <th class="text-center"> 成績 </th>--}}
{{--                                    <th class="text-center"> 二回 </th>--}}
{{--                                    <th class="text-center"> 誤椿 </th>--}}
{{--                                    <th class="text-center"> 成績 </th>--}}
{{--                                    <th class="text-center"> 三回 </th>--}}
{{--                                    <th class="text-center"> 誤椿 </th>--}}
{{--                                    <th class="text-center"> 成績 </th>--}}
{{--                                    <th class="text-center"> 四回 </th>--}}
{{--                                    <th class="text-center"> 誤椿 </th>--}}
{{--                                    <th class="text-center"> 成績 </th>--}}
{{--                                    <th class="text-center"> 五回 </th>--}}
{{--                                    <th class="text-center"> 誤椿 </th>--}}
{{--                                    <th class="text-center"> 成績 </th>--}}
{{--                                    <th class="text-center"> 最佳成績 </th>--}}
                                @endif
                            @else
                                <th class="text-center"> 一回 </th>
                                <th class="text-center"> 誤椿 </th>
                                <th class="text-center"> 二回 </th>
                                <th class="text-center"> 誤椿 </th>
                                <th class="text-center"> 成績 </th>
                            @endif
                        @else
                            @if ($scheduleId == 22 || $scheduleId == 23)
                            @else
                                <th class="text-center"> 技術一 </th>
                                <th class="text-center"> 藝術一 </th>
                                <th class="text-center"> 總分一 </th>
                                <th class="text-center"> 技術二 </th>
                                <th class="text-center"> 藝術二 </th>
                                <th class="text-center"> 總分二 </th>
                                <th class="text-center"> 技術三 </th>
                                <th class="text-center"> 藝術三 </th>
                                <th class="text-center"> 總分三 </th>
                                <th class="text-center"> 技術四 </th>
                                <th class="text-center"> 藝術四 </th>
                                <th class="text-center"> 總分四 </th>
                                <th class="text-center"> 技術五 </th>
                                <th class="text-center"> 藝術五 </th>
                                <th class="text-center"> 總分五 </th>
                                <th class="text-center"> 罰分 </th>
                            @endif
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($result) == 0)
                        <th class="text-center" colspan="20"> -- 無資料 -- </th>
                    @endif
                    @switch ($scheduleId)
                        @case(24)
                        <img src="{{ URL::asset('result/24.png') }}">

                            <tr>
                            <td class="text-center"> 1 </td>
                            <td class="text-center"> 308 </td>
                            <td class="text-center"> 鄭宇翔 </td>
                            </tr>
                            <tr>
                            <td class="text-center"> 2 </td>
                            <td class="text-center"> 427 </td>
                            <td class="text-center"> 楊凱崴 </td>
                            </tr>
                            <tr>
                            <td class="text-center"> 3 </td>
                            <td class="text-center"> 281 </td>
                            <td class="text-center"> 鄭睿綸 </td>
                            </tr>
                            <tr>
                            <td class="text-center"> 4 </td>
                            <td class="text-center"> 123 </td>
                            <td class="text-center"> 陳廷翊 </td>
                            </tr>
                            <tr>
                            <td class="text-center"> 5 </td>
                            <td class="text-center"> 309 </td>
                            <td class="text-center"> 盧奕辰 </td>
                            </tr>
                            <tr>
                            <td class="text-center"> 6 </td>
                            <td class="text-center"> 042 </td>
                            <td class="text-center"> 周柏崴 </td>
                            </tr>
                            <tr>
                            <td class="text-center"> 7 </td>
                            <td class="text-center"> 030 </td>
                            <td class="text-center"> 盧右晨 </td>
                            </tr>
                        <tr>
                            <td class="text-center"> 8 </td>
                            <td class="text-center"> 144 </td>
                            <td class="text-center"> 林子宸 </td>

                        </tr>
                        <tr>
                            <td class="text-center"> 9 </td>
                            <td class="text-center"> 086 </td>
                            <td class="text-center"> 呂秉宥 </td>

                        </tr>


                        @break
                        @case(25)
                        <img src="{{ URL::asset('result/25.png') }}">

                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center"> 046 </td>
                            <td class="text-center">丁于恩</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center"> 175 </td>
                            <td class="text-center">黃苗嫚</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center"> 282 </td>
                            <td class="text-center">江芮琳</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center"> 130 </td>
                            <td class="text-center">王佑瑜</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center"> 247 </td>
                            <td class="text-center">吳芙蓉</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-center"> 075 </td>
                            <td class="text-center">劉巧兮</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-center"> 101 </td>
                            <td class="text-center">鄭晴安</td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-center"> 260 </td>
                            <td class="text-center">游涵伃</td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td class="text-center"> 049 </td>
                            <td class="text-center">楊允彣</td>
                        </tr>


                        @break

                        @case(26)
                        <img src="{{ URL::asset('result/26.png') }}">

                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">313</td>
                            <td class="text-center">李孝恒</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">235</td>
                            <td class="text-center">吳東諺</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">342</td>
                            <td class="text-center">周祈佑</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">335</td>
                            <td class="text-center">羅振嘉</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center">338</td>
                            <td class="text-center">江皇諭</td>
                        </tr>
                        @break

                        @case(28)
                        <img src="{{ URL::asset('result/28.png') }}">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">327</td>
                            <td class="text-center">王宥鈞</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">463</td>
                            <td class="text-center">林靖宸</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">005</td>
                            <td class="text-center">楊時彥</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">390</td>
                            <td class="text-center">王于睿</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center">122</td>
                            <td class="text-center">許至騫</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-center">323</td>
                            <td class="text-center">黃秉閎</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-center">262</td>
                            <td class="text-center">陳宗緒</td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-center">408</td>
                            <td class="text-center">文宥謙</td>
                        </tr>
                        @break
                        @case(29)
                        <img src="{{ URL::asset('result/29.png') }}">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">175</td>
                            <td class="text-center">黃苗嫚</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">025</td>
                            <td class="text-center">姜亭安</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">101</td>
                            <td class="text-center">鄭晴安</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">174</td>
                            <td class="text-center">郭昱均</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center">209</td>
                            <td class="text-center">陳欣彤</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-center">325</td>
                            <td class="text-center">蕭翊淳</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-center">280</td>
                            <td class="text-center">龎式晴</td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-center">265</td>
                            <td class="text-center">林芳廷</td>
                        </tr>

                        @break
                        @case(30)
                        <img src="{{ URL::asset('result/30.png') }}">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">427</td>
                            <td class="text-center">楊凱崴</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">473</td>
                            <td class="text-center">郭加恩</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">403</td>
                            <td class="text-center">何明諠</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">459</td>
                            <td class="text-center">巫蘇宇恩</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center">030</td>
                            <td class="text-center">盧右晨</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-center">224</td>
                            <td class="text-center">劉祐呈</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-center">321</td>
                            <td class="text-center">黃品睿</td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-center">307</td>
                            <td class="text-center">李秉豐</td>
                        </tr>
                        @break
                        @case(31)
                        <img src="{{ URL::asset('result/31.png') }}">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">046</td>
                            <td class="text-center">丁于恩</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">130</td>
                            <td class="text-center">王佑瑜</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">417</td>
                            <td class="text-center">涂舒婷</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">049</td>
                            <td class="text-center">楊允彣</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center">051</td>
                            <td class="text-center">劉又瑄</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-center">437</td>
                            <td class="text-center">張芃竹</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-center">260</td>
                            <td class="text-center">游涵伃</td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-center">147</td>
                            <td class="text-center">李蘊芳</td>
                        </tr>
                        @break
                        @case(32)
                        <img src="{{ URL::asset('result/32.png') }}">

                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">123</td>
                            <td class="text-center">陳廷翊</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">311</td>
                            <td class="text-center">賴徐捷</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">308</td>
                            <td class="text-center">鄭宇翔</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">281</td>
                            <td class="text-center">鄭睿綸</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center">144</td>
                            <td class="text-center">林子宸</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td class="text-center">042</td>
                            <td class="text-center">周柏崴</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td class="text-center">271</td>
                            <td class="text-center">張唯仁</td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td class="text-center">097</td>
                            <td class="text-center">劉宇軒</td>
                        </tr>

                        @break
                        @case(33)
                        <img src="{{ URL::asset('result/33.png') }}">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">313</td>
                            <td class="text-center">李孝恒</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">274</td>
                            <td class="text-center">陳志緯</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">342</td>
                            <td class="text-center">周祈佑</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">339</td>
                            <td class="text-center">郭景玄</td>
                        </tr>
                        @break
                        @case(34)
                        <img src="{{ URL::asset('result/34.png') }}">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">257</td>
                            <td class="text-center">蕭秉昇</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">258</td>
                            <td class="text-center">楊曾智</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">333</td>
                            <td class="text-center">陳昱錡</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">235</td>
                            <td class="text-center">吳東諺</td>
                        </tr>
                        @break

                        @default

                        @foreach ($result as $key => $val)
                            <tr>
                                <td class="text-center">
                                    @if ($val->final_result <> '無成績')


                                    @if ($scheduleId == 11 ||$scheduleId == 12 ||$scheduleId == 13 ||$scheduleId == 14 ||$scheduleId == 15 ||$scheduleId == 16 ||$scheduleId == 17 ||$scheduleId == 18 ||$scheduleId == 19 ||$scheduleId == 20)
                                        @if ($remark == '取八強')
                                            @if ($key<8)
                                                    ★
                                            @endif
                                        @endif
                                        @if ($remark == '取四強')
                                                @if ($key<4)
                                                    ★
                                                @endif
                                        @endif
                                    @endif
                                        {{ $key + 1 }}
                                    @endif
                                </td>
                                <td class="text-center"> {{ $val->player_number }}</td>
                                <td class="text-center"> {{ $val->name }}</td>
                                @if ($scheduleId >= 24 || ($scheduleId >= 11 && $scheduleId <= 20 ))

                                    <td class="text-center"> {{ $val->round_one_second }}</td>
                                    <td class="text-center"> {{ $val->round_one_miss_conr == 99 ? '超過5次' : $val->round_one_miss_conr }}</td>
                                    <td class="text-center"> {{ $val->round_two_second }}</td>
                                    <td class="text-center"> {{ $val->round_two_miss_conr == 99 ? '超過5次' : $val->round_two_miss_conr }}</td>
                                    <td class="text-center"> {{ $val->final_result }}</td>

                                @else

                                    @if ($scheduleId == 22 || $scheduleId == 23)
                                    @else
                                        <td class="text-center"> {{ $val->skill_1 }}</td>
                                        <td class="text-center"> {{ $val->art_1 }}</td>
                                        <td class="text-center"> {{ $val->score_1 }}</td>
                                        <td class="text-center"> {{ $val->skill_2 }}</td>
                                        <td class="text-center"> {{ $val->art_2 }}</td>
                                        <td class="text-center"> {{ $val->score_2 }}</td>
                                        <td class="text-center"> {{ $val->skill_3 }}</td>
                                        <td class="text-center"> {{ $val->art_3 }}</td>
                                        <td class="text-center"> {{ $val->score_3 }}</td>
                                        <td class="text-center"> {{ $val->skill_4 }}</td>
                                        <td class="text-center"> {{ $val->art_4 }}</td>
                                        <td class="text-center"> {{ $val->score_4 }}</td>
                                        <td class="text-center"> {{ $val->skill_5 }}</td>
                                        <td class="text-center"> {{ $val->art_5 }}</td>
                                        <td class="text-center"> {{ $val->score_5 }}</td>
                                        <td class="text-center"> {{ $val->punish }}</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                        @break
                    @endswitch
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#m_select2_1").change(function() {
            var scheduleSn = $(this).val();
            window.location = "{{ URL('search/result/') }}/" + scheduleSn
        });
    </script>
@endsection
