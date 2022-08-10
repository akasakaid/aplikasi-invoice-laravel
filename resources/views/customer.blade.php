<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Customer</title>
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}" />
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="{{asset('js/uikit-icons.min.js')}}"></script>
</head>
<body>
    <div class="uk-container">
        <div class="uk-container uk-margin-top">
            <div class="uk-margin-top">
                <a href="/add-customer" class="uk-button uk-button-primary">Tambah Customer</a>
                <a href="/invoice" class="uk-button uk-button-secondary">Go To Invoice</a>
                <table class="uk-table uk-table-divider">
                    <thead>
                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($customer as $i)
                        <tr>
                            <td>{{$i->id}}</td>
                            <td>{{$i->nama_customer}}</td>
                            <td>{{$i->telp}}</td>
                            <td>{{$i->alamat}}</td>
                            <td>
                                <a href="/edit-customer/{{$i->id}}" class="uk-button uk-button-secondary">Edit</a>
                                <a href="/delete-customer/{{$i->id}}" class="uk-button uk-button-danger">Hapus</a>
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