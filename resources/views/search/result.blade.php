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
                        <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : null }}>{{ $schedule->order }}
                            - {{ $schedule->level }}  {{ $schedule->group }}  {{ $schedule->gender }}子組 {{ $schedule->item }} {{ $schedule->game_type }} {{ $schedule->remark }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>

                        @switch ($model)
                            @case('speed')
                            <th class="text-center"> 名次</th>
                            <th class="text-center"> 選手</th>
                            <th class="text-center"> 一回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 二回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 成績</th>
                            @break;
                            @case('freeStyle')
                            <th class="text-center"> 名次</th>
                            <th class="text-center"> 選手</th>
                            <th class="text-center"> 技術一</th>
                            <th class="text-center"> 藝術一</th>
                            <th class="text-center"> 總分一</th>
                            <th class="text-center"> 技術二</th>
                            <th class="text-center"> 藝術二</th>
                            <th class="text-center"> 總分二</th>
                            <th class="text-center"> 技術三</th>
                            <th class="text-center"> 藝術三</th>
                            <th class="text-center"> 總分三</th>
                            <th class="text-center"> 技術四</th>
                            <th class="text-center"> 藝術四</th>
                            <th class="text-center"> 總分四</th>
                            <th class="text-center"> 技術五</th>
                            <th class="text-center"> 藝術五</th>
                            <th class="text-center"> 總分五</th>
                            <th class="text-center"> 罰分</th>
                            @break;

                            @case('stop')
                            <th class="text-center"> 名次</th>
                            <th class="text-center"> 選手</th>
                            @break;
                            @case('pk')
                            <th class="text-center"> 名次</th>
                            <th class="text-center"> 選手</th>
                            <th class="text-center"> 一回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 成績</th>
                            <th class="text-center"> 二回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 成績</th>
                            <th class="text-center"> 三回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 成績</th>
                            <th class="text-center"> 四回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 成績</th>
                            <th class="text-center"> 五回</th>
                            <th class="text-center"> 誤椿</th>
                            <th class="text-center"> 成績</th>
                            <th class="text-center"> 最佳成績</th>
                            @break;
                        @endswitch
                    </tr>
                    </thead>
                    <tbody>
                    @switch ($model)
                        @case('speed')
                        @foreach ($result as $key => $val)
                            <tr>
                                <td class="text-center"> {{ $val->rank }}</td>
                                <td class="text-center"> {{$val->name}}({{ $val->player_number }})</td>
                                <td class="text-center"> {{ $val->round_one_second }}</td>
                                <td class="text-center"> {{ $val->round_one_miss_conr == 99 ? '超過5次' : $val->round_one_miss_conr }}</td>
                                <td class="text-center"> {{ $val->round_two_second }}</td>
                                <td class="text-center"> {{ $val->round_two_miss_conr == 99 ? '超過5次' : $val->round_two_miss_conr }}</td>
                                <td class="text-center"> {{ $val->final_result }}</td>
                            </tr>
                        @endforeach
                        @break;
                        @case('freeStyle')
                        @if ($scheduleInfo->item == '雙人花式繞樁')
                            <tr>
                                <th class="text-center"> 1</th>
                                <th class="text-center"> 侯鈞諺、陳建廷</th>
                                <th class="text-center">25</th>
                                <th class="text-center">73</th>
                                <th class="text-center">98</th>
                                <th class="text-center">24</th>
                                <th class="text-center">84</th>
                                <th class="text-center">108</th>
                                <th class="text-center">29</th>
                                <th class="text-center">90</th>
                                <th class="text-center">119</th>
                                <th class="text-center">26</th>
                                <th class="text-center">77</th>
                                <th class="text-center">103</th>
                                <th class="text-center">23</th>
                                <th class="text-center">74</th>
                                <th class="text-center">97</th>
                                <th class="text-center">11</th>
                            </tr>
                            <tr>
                                <th class="text-center"> 2</th>
                                <th class="text-center"> 范子聿、游瑋筑</th>
                                <th class="text-center">33</th>
                                <th class="text-center">67</th>
                                <th class="text-center">100</th>
                                <th class="text-center">31</th>
                                <th class="text-center">70</th>
                                <th class="text-center">101</th>
                                <th class="text-center">37</th>
                                <th class="text-center">82</th>
                                <th class="text-center">119</th>
                                <th class="text-center">32</th>
                                <th class="text-center">65</th>
                                <th class="text-center">97</th>
                                <th class="text-center">29</th>
                                <th class="text-center">64</th>
                                <th class="text-center">93</th>
                                <th class="text-center">1</th>
                            </tr>
                            {{--                             --}}
                            <tr>
                                <th class="text-center"> 3</th>
                                <th class="text-center"> 邱映瑄、邱宇廷</th>
                                <th class="text-center">20</th>
                                <th class="text-center">66</th>
                                <th class="text-center">86</th>
                                <th class="text-center">15</th>
                                <th class="text-center">56</th>
                                <th class="text-center">71</th>
                                <th class="text-center">25</th>
                                <th class="text-center">75</th>
                                <th class="text-center">100</th>
                                <th class="text-center">20</th>
                                <th class="text-center">63</th>
                                <th class="text-center">83</th>
                                <th class="text-center">22</th>
                                <th class="text-center">70</th>
                                <th class="text-center">92</th>
                                <th class="text-center">10</th>
                            </tr>

                            <tr>
                                <th class="text-center"> 4</th>
                                <th class="text-center"> 黃淇宣、范予僖</th>

                                <th class="text-center">27</th>
                                <th class="text-center">61</th>
                                <th class="text-center">88</th>
                                <th class="text-center">24</th>
                                <th class="text-center">60</th>
                                <th class="text-center">84</th>
                                <th class="text-center">25</th>
                                <th class="text-center">70</th>
                                <th class="text-center">95</th>
                                <th class="text-center">20</th>
                                <th class="text-center">53</th>
                                <th class="text-center">73</th>
                                <th class="text-center">23</th>
                                <th class="text-center">60</th>
                                <th class="text-center">83</th>
                                <th class="text-center">5</th>
                            </tr>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center"> 謝牧倫、周柏崴</th>
                                <th class="text-center">31</th>
                                <th class="text-center">85</th>
                                <th class="text-center">116</th>
                                <th class="text-center">36</th>
                                <th class="text-center">105</th>
                                <th class="text-center">141</th>
                                <th class="text-center">44</th>
                                <th class="text-center">113</th>
                                <th class="text-center">157</th>
                                <th class="text-center">44</th>
                                <th class="text-center">92</th>
                                <th class="text-center">136</th>
                                <th class="text-center">34</th>
                                <th class="text-center">82</th>
                                <th class="text-center">116</th>
                                <th class="text-center">4</th>
                            </tr>

                        @else

                            @foreach ($result as $key => $val)
                                <tr>
                                    <td class="text-center"> {{ $val->rank }}</td>
                                    <td class="text-center"> {{$val->name}}({{ $val->player_number }})</td>
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
                                </tr>
                            @endforeach
                        @endif
                        @break;
                        @case('stop')

                        <td class="text-center"> {{ $val->rank }}</td>
                        <td class="text-center"> {{$val->name}}({{ $val->player_number }})</td>
                        @break;
                        @case('pk')
                        @switch ($scheduleInfo->order)
                            @case('場次32')
                            @break;
                            @case('場次33')
                            @break;
                            @case('場次34')
                            @break
                        @endswitch
                        @break;
                    @endswitch

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#m_select2_1").change(function () {
            var scheduleSn = $(this).val();
            window.location = "{{ URL('search/result/') }}/" + scheduleSn
        });
    </script>
@endsection
