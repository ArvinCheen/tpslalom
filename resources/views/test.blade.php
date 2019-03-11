<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<table class="table">
    @foreach ($schedules as $schedule)
        @foreach ($locals as $local)
            @foreach ($genders as $gender)

                <?php
                $datas = \App\Models\EnrollModel::where('level', $schedule->level)
                    ->where('group', $schedule->group)
                    ->where('item', $schedule->item)
                    ->where('gameSn', $schedule->gameSn)
                    ->whereNotNull('rank')
                    ->orderBy('rank')
                    ->with(['player' => function ($query) use ($local, $gender) {
                        if ($local == '臺北市') {
                            $query->where('city', '臺北市');
                        } else {
                            $query->where('city', '', '非北市');
                        }

                            $query->where('gender', $gender);
                    }])
                    ->get();

                $x = 0;
                foreach ($datas as $data) {
                    if (isset($data->player->name)) {
                        $x++;
                    }
                }

                if ($x == 0) {
                    continue;
                }
                ?>
                <tr>
                    <td colspan="9" class=" text-center">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="9" class=" text-center"> {{ $local }}</td>
                </tr>
                <tr>
                    <td>場次</td>
                    <td>名次</td>
                    <td>編號</td>
                    <td>姓名</td>
                    <td>選手組別</td>
                    <td>年級組別</td>
                    <td>項目</td>
                    <td>單位</td>
                    <td>成績</td>
                </tr>
                @foreach ($datas as $data)
                    @if (isset($data->player->name))

                        <tr>
                            <td>{{ str_replace('場次','', $schedule->order) }}</td>
                            <td>{{ $data->rank }}</td>
                            <td>{{ $data->playerNumber}}</td>
                            <td>{{ $data->player->name}}</td>
                            <td>{{ $data->group . $data->player->gender . '子組' }}</td>
                            <td>{{ $data->level }}</td>
                            <td>{{ $data->item }}</td>
                            <td>{{ $data->player->agency }}</td>
                            <td>{{ $data->finalResult }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        @endforeach

    @endforeach
</table>


<script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>