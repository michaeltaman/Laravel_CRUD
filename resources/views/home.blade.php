
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    @component('components.error-list')
    @endcomponent

    @auth
        <p><strong>Welcome, <span style="color: green;">{{ Auth::user()->name }} !!! </span></strong></p>
        <form action="/logout" method="POST">
            @csrf
            <button style="margin-bottom: 10px;">Logout</button>
        </form>
        <div style="border: 3px solid black; margin-bottom: 10px;">
            <h2 style="margin-left: 10px;">Create New Post</h2>
            <form style="margin-left: 10px;" action="/create-post" method="POST" >
                @csrf
                <div class="form-group" style="display: flex; align-items: flex-end; margin-bottom: 10px;">
                    <input type="text" name="title" placeholder="post title" style="margin-right: 10px;">
                    <textarea name="body" placeholder="body content ..." style="margin-right: 10px; height: 14px;"></textarea>
                    <button>Save Post</button>
                </div>
            </form>
        </div>

        <div style="border: 3px solid black; margin-bottom: 10px;">
            <h2 style="margin-left: 10px;">My Posts</h2>
            @foreach ($posts as $post)
                <div style="background-color: rgb(203, 202, 202); padding: 10px; margin: 10px;">
                    <h3>{{$post['title']}} by <span style="color:rgb(2, 65, 2); font:bold;">{{$post->user->name}}</span></h3>
                    {{$post['body']}}
                    <div style="display: flex; align-items: center; ">
                        <p style="margin-right: 20px;">
                            <a href="/edit-post/{{$post->id}}">Edit</a>
                            <form action="delete-post/{{$post->id}}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="container" >

            <form novalidate style="border: 3px solid black; margin-bottom: 10px;" method="POST" action="{{ route('register') }}">
                <h2 style="margin-left: 10px;">Register</h2>
                @csrf

                <div class="form-group" style="margin-left: 10px;  margin-bottom:5px;">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group" style="margin-left: 10px; margin-bottom:5px;">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>
                </div>

                <div class="form-group" style="margin-left: 10px; margin-bottom:5px;">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group" style="margin-left: 10px; margin-bottom:5px;">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <br/>
                <button style="margin-left: 10px;" type="submit" class="btn btn-primary">Register</button>
                <p></p>
            </form>
        </div>
    @endauth
        <div class="container">

            <form novalidate style="border: 3px solid black;" method="POST" action="{{ route('login') }}">
                <h2 style="margin-left: 10px;">Login</h2>
                @csrf

                <div class="form-group" style="margin-left: 10px; margin-bottom:5px;">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="login_name" name="login_name" required>
                </div>

                <div class="form-group" style="margin-left: 10px; margin-bottom:5px;">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="login_password" name="login_password" required>
                </div>

                <br/>
                <button style="margin-left: 10px;" type="submit" class="btn btn-primary">Login</button>
                <p></p>
            </form>
        </div>


    </body>
</html>