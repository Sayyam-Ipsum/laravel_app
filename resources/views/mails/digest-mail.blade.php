<!DOCTYPE html>
<html>
<head>
    <title>Daily Digest</title>
</head>
<body>
<h1>Top Posts of the Day</h1>
<ul>
    @if(count($posts))
    @foreach ($posts as $post)
        <li>{{ $post->text }}</li>
    @endforeach
    @endif
</ul>
</body>
</html>
