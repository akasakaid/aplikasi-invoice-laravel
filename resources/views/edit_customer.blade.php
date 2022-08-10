<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}" />
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="{{asset('js/uikit-icons.min.js')}}"></script>
</head>
<body>
    <div class="uk-container">
        <div class="uk-container uk-margin-top">
            <div class="uk-margin-top uk-flex">
                <div class="uk-align-center">
                    <span class="uk-text-large uk-text-primary">Form Edit Customer</span>
                    <form action="/update-customer" method="POST" class="uk-form-width-large" id="add-form">
                        @csrf
                        <input type="hidden" name="id" value="{{$customer->id}}">
                        <div class="uk-margin-top">
                            <label for="nama" class="uk-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="uk-input" value="{{$customer->nama_customer}}" required>
                        </div>
                        <div class="uk-margin top">
                            <label for="telp" class="uk-label">Telp</label>
                            <input type="text" name="telp" id="telp" class="uk-input" value={{$customer->telp}} required>

                        </div>
                        <div class="uk-margin-top">
                            <label for="label" class="uk-label">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="uk-input" value="{{$customer->alamat}}" required>

                        </div>
                        <div class="uk-margin-top">
                            <input type="submit" value="Update" class="uk-button uk-button-primary">
                            <a href="/customer" class="uk-button uk-button-secondary">Kembali</a>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>