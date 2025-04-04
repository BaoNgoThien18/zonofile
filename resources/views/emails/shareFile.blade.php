<!DOCTYPE html>
<html>
<head>
    <title>Example Email</title>
</head>
<body>
    <h1>Xin chào</h1>
    <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
    <p> {{$data['user']->email }} đã chia sẻ file cho bạn <a href="{{ url('shared/' . $data['file']->shared_id) }}">{{ $data['file']->title }}</a></p>


</body>
</html>
