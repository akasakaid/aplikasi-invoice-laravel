<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Invoice</title>
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}" />
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="{{asset('js/uikit-icons.min.js')}}"></script>
</head>
<body>
    <div class="uk-container">
        <div class="uk-container uk-margin-top">
            <div class="uk-margin-top">
                <a href="/add-invoice" class="uk-button uk-button-primary">Tambah Invoice</a>
                <a href="/customer" class="uk-button uk-button-secondary">Go To Customer</a>
                <table class="uk-table uk-table-divider">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No Invoice</th>
                        <th>Nama Customer</th>
                        <th>Catatan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="">
                                <td>{{$item->id_invoice}}</td>
                                <td>{{$item->tgl_invoice}}</td>
                                <td>{{$item->id_invoice}}</td>
                                <td>{{$item->nama_customer}}</td>
                                <td>{{$item->catatan}}</td>
                                <td>{{$item->total}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    <a href="/detail/{{$item->id_invoice}}" class="uk-button uk-button-primary">Detail</a>
                                    <a href="/edit-invoice/{{$item->id_invoice}}" class="uk-button uk-button-secondary">Edit</a>
                                    <a href="/delete-invoice/{{$item->id_invoice}}" class="uk-button uk-button-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>