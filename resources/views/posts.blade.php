<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-5">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-center">Lista de Posts</h1>

        <input type="text" id="search" placeholder="Buscar post..." 
               class="w-full p-2 border border-gray-300 rounded mb-4">

        <ul id="post-list" class="space-y-2">
            @foreach ($posts as $post)
                <li class="p-3 bg-gray-200 rounded shadow-md">{{ $post['title'] }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        document.getElementById("search").addEventListener("input", function () {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll("#post-list li");

            items.forEach(item => {
                let text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? "block" : "none";
            });
        });
    </script>
</body>
</html>
