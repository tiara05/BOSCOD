<table border="1">
    <thead>
        <tr>
            <td width="50px">No</td>
            <td width="100px">Nama Merek</td>
        </tr>
    </thead>
    @php
        $no = 1;
    @endphp
    @foreach ($data as $item)
    <tbody>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->nama_merek }}</td>
        </tr>
    </tbody>
    @endforeach
</table>