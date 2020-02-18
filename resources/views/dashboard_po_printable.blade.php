<table border="1">
    <thead>
        <th>PO No</th>
        <th>Subject</th>
        <th>grand_total</th>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->po_no }}</td>
            <td>{{ $item->subject }}</td>
            <td>{{ $item->grand_total }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>