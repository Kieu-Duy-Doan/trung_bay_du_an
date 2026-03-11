<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ route('storage/assets/css/base.css') }}">
</head>

<body>
    <div style="width: 700px" class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card w-100">
            <div class="card-body shadow">
                <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control {{ isset($errors['email']) ? 'is-invalid' : '' }}"
                            name="email">
                        @if (isset($errors['email']))
                            <div class="invalid-feedback">
                                {{ $errors['email'] }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="text" class="form-control {{ isset($errors['password']) ? 'is-invalid' : '' }}"
                            name="password">
                        @if (isset($errors['email']))
                            <div class="invalid-feedback">
                                {{ $errors['password'] }}
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <button class="btn btn-primary">Đăng nhập</button>
                    </div>
                    @if (isset($error))
                        <p class="text-danger">{{ $error }}</p>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
