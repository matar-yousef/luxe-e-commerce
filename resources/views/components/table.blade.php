<div class="table-responsive">
    <table class="table table-bordered table-hover text-center m-0">
        <thead class="bg-light">
            <tr>
                @foreach($headers as $header)
                <th class="align-middle">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="align-middle">
            {{ $slot }}
        </tbody>
    </table>
</div>