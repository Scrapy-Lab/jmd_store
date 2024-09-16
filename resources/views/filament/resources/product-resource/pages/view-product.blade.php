<x-filament-panels::page>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
        }
    </style>
    <h1>{{ $record->name }}</h1>


    <table>
        <thead>
            <tr>
                <th>DATE</th>
                <th>RECEIVED</th>
                <th>ISSUE</th>
                <th>BALANCED</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productData as $key => $data)
                <tr>

                    @if ($key == 'product')
                        <td>{{  \Carbon\Carbon::parse($data['created_at'])->format('d/m/Y') ?? '' }}</td>
                        <td>{{ $record['box'] }}</td>
                        <td></td>
                        @php
                            $balance = $record['box'];
                        @endphp
                    @else
                        {{-- @dd($data, $key) --}}
                        @foreach ($data as $key => $gatepassProduct)
                <tr>
                    <td>{{  \Carbon\Carbon::parse($gatepassProduct['created_at'])->format('d/m/Y') }}</td>
                    <td></td>
                    <td>{{ $gatepassProduct->pivot->box }}</td>
                    @php
                        // $balance = 0;

                        $balance -= $gatepassProduct->pivot->box ;


                    @endphp
                    <td>{{ $balance }}</td>
                </tr>
            @endforeach
            @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</x-filament-panels::page>