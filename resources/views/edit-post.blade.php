<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form class="form-group" action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method ('PUT')
        <div style="display: flex; align-items: flex-end;">
            <input type="text" name="title" value="{{$post->title}}" style="margin-right: 10px;">
            <textarea name="body" style="margin-right: 10px; margin-bottom: 1px; height: 20px;">{{$post->body}}</textarea>
            <button>Save Changes</button>
        </div>
    </form>
</body>
</html>