<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex flex-col items-center justify-center h-screen w-screen">
        <h2 class="text-center text-2xl font-semibold mb-5">Login Page</h2>
        <form action="" method="post" class="flex flex-col gap-3 w-[300px] p-5 border border-purple-900 rounded-lg bg-slate-100">
            <div class="flex flex-col">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="border border-purple-900 p-2 rounded-lg">
            </div>

            <div class="flex flex-col">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="border border-purple-900 p-2 rounded-lg">
            </div>

            <button type="submit" class="bg-purple-900 text-white px-4 py-2">Login</button>
        </form>
    </div>

</body>
</html>