<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Customer</title>
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}" />
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="{{asset('js/uikit-icons.min.js')}}"></script>
</head>
<body>
    <div class="uk-container">
        <div class="uk-container uk-margin-top">
            <div class="uk-margin-top uk-flex">
                <div class="uk-align-center">
                    <span class="uk-text-large uk-text-primary">Form Tambah Invoice</span>
                    <form action="/add-invoice" method="post" class="uk-form-width-xlarge" id="add_form">
                        @csrf
                        <div class="uk-margin-top">
                            <label for="no_invoice" class="uk-label">No Invoice</label>
                            <input type="number" name="no_invoice" id="no_invoice" class="uk-input" value="{{$no_invoice}}" required>
                        </div>
                        <div class="uk-margin-top">
                            <label for="tgl_invoice" class="uk-label">Tanggal Invoice</label>
                            <input type="date" name="tgl_invoice" id="tgl_invoice" class="uk-input" required>
                        </div>

                        <div class="uk-margin-top">
                            <label for="customer" class="uk-label">Customer</label>
                            <select name="customer" id="customer" class="uk-select">
                                @foreach ($data as $data)
                                    <option value="{{$data->nama_customer}}">{{$data->nama_customer}}</option>
                                @endforeach
                            </select>
                        </div>
                                
                        <div class="uk-margin-top">
                            <label for="Status" class="uk-label">Status</label>
                            <select name="status" id="status" class="uk-select">
                                <option value="paid">Paid</option>
                                <option value="unpaid">UnPaid</option>
                            </select>
                            
                        </div>
                        <div class="uk-margin-top">
                            <label for="catatan" class="uk-label">Catatan</label>
                            <input type="text" name="catatan" id="catatan" class="uk-input" required>
                        </div>
                        
                        <div class="uk-margin-top">
                            <input type="submit" value="Tambah Invoice" class="uk-button uk-button-primary">
                            <a href="/invoice" class="uk-button uk-button-secondary">Kembali</a>
                        </div>
                        <div class="uk-margin-top uk-margin-bottom">
                            <span class="uk-text-large uk-text-primary">List Item</span>
                        </div>
                        <table class="uk-table uk-table-divider uk-margin-top">
                            <tbody id="list-item">
                                <tr>
                                    <td><input type="text" name="nama_item[]" id="nama-item" class="uk-input uk-form-width-small" placeholder="Nama Item"></td>
                                    <td><input type="number" name="harga[]" id="harga" class="uk-input uk-form-width-small" placeholder="Harga"></td>
                                    <td><input type="number" name="diskon[]" id="diskon" class="uk-input uk-form-width-small" placeholder="Diskon"></td>
                                    <td><input type="number" name="subtotal[]" id="subtotal" class="uk-input uk-form-width-small" placeholder="Sub Total"></td>
                                    <td><input type="number" name="total[]" id="total" class="uk-input uk-form-width-small" placeholder="Total"></td>
                                    <td><button class="uk-button uk-button-primary" id="add">Tambah</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#add').click(function (e) { 
            e.preventDefault();
            $('#list-item').append(`                                <tr>
                <td><input type="text" name="nama_item[]" id="nama-item" class="uk-input uk-form-width-small" placeholder="Nama Item"></td>
                                    <td><input type="number" name="harga[]" id="harga" class="uk-input uk-form-width-small" placeholder="Harga"></td>
                                    <td><input type="number" name="diskon[]" id="diskon" class="uk-input uk-form-width-small" placeholder="Diskon"></td>
                                    <td><input type="number" name="subtotal[]" id="subtotal" class="uk-input uk-form-width-small" placeholder="Sub Total"></td>
                                    <td><input type="number" name="total[]" id="total" class="uk-input uk-form-width-small" placeholder="Total"></td>
                                    <td><button class="uk-button uk-button-danger" id="btn-hapus">Hapus</button></td>
                                </tr>`);
        });
        $(document).on('click','#btn-hapus', function (e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });

});
</script>
</html>