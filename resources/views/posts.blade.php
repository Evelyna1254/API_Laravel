<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-5">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-center">Lista de Posts</h1>

        <!-- Mensajes de éxito -->
        <div id="message" class="hidden p-3 mb-4 bg-green-200 text-green-800 rounded"></div>

        <!-- Filtro de búsqueda -->
        <input type="text" id="search" placeholder="Buscar post..."   class="w-full p-2 border border-gray-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <!-- Formulario para agregar un nuevo post -->
        <form id="post-form" class="mb-4">
            <input type="text" id="title" placeholder="Título" class="w-full p-2 border rounded mb-2" required>
            <textarea id="body" placeholder="Contenido" class="w-full p-2 border rounded mb-2" required></textarea>
            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded">Agregar Post</button>
        </form>

        <!-- Lista de posts -->
        <ul id="post-list" class="space-y-2">
            @foreach ($posts as $post)
                <li class="p-3 bg-gray-200 rounded shadow-md flex justify-between items-center" data-id="{{ $post['id'] }}">
                    <span>{{ $post['title'] }}</span>
                    <button class="text-red-500 delete-btn">Eliminar</button>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const postList = document.getElementById("post-list");
            const postForm = document.getElementById("post-form");
            const titleInput = document.getElementById("title");
            const bodyInput = document.getElementById("body");
            const messageDiv = document.getElementById("message");

            // Agregar Post dinámicamente
            postForm.addEventListener("submit", function(event) {
                event.preventDefault();

                let title = titleInput.value.trim();
                let body = bodyInput.value.trim();
                if (title === "" || body === "") return;

                // Simulamos un ID único
                let newId = Date.now();

                // Crear nuevo elemento en la lista
                let newPost = document.createElement("li");
                newPost.className = "p-3 bg-gray-200 rounded shadow-md flex justify-between items-center";
                newPost.setAttribute("data-id", newId);
                newPost.innerHTML = `<span>${title}</span>
                    <button class="text-red-500 delete-btn">Eliminar</button>`;

                postList.prepend(newPost); // Agregar al inicio

                // Mostrar mensaje de éxito
                showMessage("Post agregado correctamente");

                // Limpiar formulario
                titleInput.value = "";
                bodyInput.value = "";
            });

            // Eliminar Post dinámicamente
            postList.addEventListener("click", function(event) {
                if (event.target.classList.contains("delete-btn")) {
                    let postItem = event.target.closest("li");
                    postItem.remove();
                    showMessage("Post eliminado correctamente");
                }
            });

            function showMessage(msg) {
                messageDiv.textContent = msg;
                messageDiv.classList.remove("hidden");
                setTimeout(() => messageDiv.classList.add("hidden"), 2000);
            }
        });
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
