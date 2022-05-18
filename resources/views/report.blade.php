<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Report') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table>
                <thead>
                    <th>Reporter</th>
                    <th>Image</th>
                    <th>Location></th>
                </thead>

                <tbody>
                    @foreach ($data as $report)
                        <tr>
                            <td>{{$report->reporter->name}}</td>
                            <td><img src="{{$report->image}}"/></td>
                            <td>{{$report->location_lat}}, {{$report->location_long}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
