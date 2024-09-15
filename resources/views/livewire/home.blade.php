<section>
    <div>
        <div class="flex items-center">
            <input type="date" class="bg-gray-400 text-black placeholder:text-black" wire:model="starting"
                placeholder="Starting Date" />
            <input type="date" class="bg-gray-400 text-black placeholder:text-black" wire:model="ending"
                placeholder="Endind date" />
            <button wire:click="fetch" class="px-4 py-2 m-4 bg-blue-500 text-white">Fetch</button>
        </div>
        <div class="flex items-center" wire:loading wire:target="fetch">
            <span class="loading loading-infinity loading-lg"></span>
            <span>Loading...</span>
        </div>
    </div>
    @if ($analytics)
        <div class="grid grid-cols-2 gap-6 max-w-2xl m-auto w-full">
            <div class="flex items-center justify-between p-3 bg-black text-white">
                <h2>Total Users from United States</h2>
                <span>{{ $analytics['totals']['US'] }}</span>
            </div>

            <div class="flex items-center justify-between p-3 bg-black text-white">
                <h2>Total Users from United Kingdom</h2>
                <span>{{ $analytics['totals']['UK'] }}</span>
            </div>
        </div>
    @endif
    <div class="overflow-x-auto">
        @if ($analytics)
            <table class="table table-xs">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Country</th>
                        <th>PageViews</th>
                        <th>Events</th>
                        <th>ActiveUsers</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($analytics['report'] as $key => $item)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{{ $item['country'] }}</td>
                            <td>{{ $item['screenPageViews'] }}</td>
                            <td>{{ $item['eventCount'] }}</td>
                            <td>{{ $item['activeUsers'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>
