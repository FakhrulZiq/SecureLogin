<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: #23305a;
            margin-top: 0;
        }

        .username {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #23305a;
        }

        .logout-btn {
            display: block;
            width: 100%;
            padding: 10px 0;
            border-radius: 50px;
            background-color: #23305a;
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #1a2647;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profile Page</h1>
        <div class="username">
            <h1>Welcome,{{ auth()->user()->username }}</h1>
        </div>
        
        <form action="/logout" method="POST">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
