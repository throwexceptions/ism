<h2>SHIPPED</h2>
<table border="1">
    <thead>
        <th>SO No</th>
        <th>Subject</th>
        <th>Status</th>
        <th>grand_total</th>
    </thead>
    <tbody>
        @foreach ($data as $item)
        @if($item->status == 'Shipped')
           <tr>
           <td>{{ $item->so_no }}</td>
           <td>{{ $item->subject }}</td>
           <td>{{ $item->status }}</td>
           <td>{{ $item->grand_total }}</td>
           </tr>
       @endif
        @endforeach
    </tbody>
</table>
<h2>Quote</h2>
<table border="1">
    <thead>
        <th>SO No</th>
        <th>Subject</th>
        <th>Status</th>
        <th>grand_total</th>
    </thead>
    <tbody>
        @foreach ($data as $item)
         @if($item->status == 'Quote')
            <tr>
            <td>{{ $item->so_no }}</td>
            <td>{{ $item->subject }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->grand_total }}</td>
            </tr>
        @endif
        @endforeach
    </tbody>
</table>