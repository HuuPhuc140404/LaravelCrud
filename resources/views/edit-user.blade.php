<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa Sinh Viên</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f9fc;
    }

    .container {
      background-color: #fff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 600px;
    }

    h1 {
      font-weight: 600;
      color: #333;
    }

    label {
      font-weight: 500;
      color: #555;
    }

    .btn {
      border-radius: 50px;
      padding: 10px 20px;
    }

    .btn:hover {
      opacity: 0.9;
    }

    .alert {
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h1 class="text-center mb-4">Sửa Sinh Viên</h1>

    @if (Session::has('fail'))
    <div class="alert alert-danger">
      {{ Session::get('fail') }}
    </div>
    @endif

    <form action="{{ route('EditUser') }}" method="POST">
      @csrf
      <input type="hidden" name="id" value="{{ $user->id }}">
      
      <div class="mb-3">
        <label for="studentId" class="form-label">Mã Sinh Viên</label>
        <input type="text" class="form-control" id="studentId" value="{{$user->masv}}" name="studentId" placeholder="Nhập mã sinh viên">
        @error('studentId')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="studentName" class="form-label">Tên Sinh Viên</label>
        <input type="text" class="form-control" id="studentName" value="{{$user->name}}" name="studentName" placeholder="Nhập tên sinh viên">
        @error('studentName')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="studentEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="studentEmail" value="{{$user->email}}" name="studentEmail" placeholder="Nhập email sinh viên">
        @error('studentEmail')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="studentPhone" class="form-label">Số Điện Thoại</label>
        <input type="text" class="form-control" id="studentPhone" value="{{$user->sdt}}" name="studentPhone" placeholder="Nhập số điện thoại sinh viên">
        @error('studentPhone')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="studentAddress" class="form-label">Địa Chỉ</label>
        <input type="text" class="form-control" id="studentAddress" value="{{$user->address}}" name="studentAddress" placeholder="Nhập địa chỉ sinh viên">
        @error('studentAddress')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="btn btn-success">Lưu Sinh Viên</button>
      <a href="{{ route('users')}}" class="btn btn-primary">Quay Lại</a>
    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
