<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prueba Técnica</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://horizon-ui.com/shadcn-nextjs-boilerplate/_next/static/css/12f72a06cf11dcdf.css" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        
    </head>
    <body>
    <!-- Título principal de la página -->
        <h1 class="text-center mt-4">Prueba Técnica - PEDBOX</h1>

        <!-- Contenedor principal con los dos divs alineados horizontalmente -->
        <div class="container d-flex justify-content-center align-items-center" style="height: calc(100vh - 60px);">
            <!-- Contenedor de los reddits -->
            <div id="reddits-container" class="me-4 p-3 border rounded" style="width: 45%; height: 80%; overflow-y: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);">
                <h4 class="text-center">Noticias de Reddit</h4>
                <!-- Aquí se mostrarán las tarjetas de los reddits -->
            </div>

            <!-- Contenedor de los subreddits -->
            <div id="subreddits-container" class="p-3 border rounded" style="width: 45%; height: 80%; overflow-y: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);">
                <h4 class="text-center">Subreddits</h4>
                <ul id="subreddits-list" class="list-group">
                    <!-- Aquí se mostrarán los subreddits -->
                </ul>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const redditsContainer = document.getElementById('reddits-container');
                const subredditsContainer = document.getElementById('subreddits-container');

                // Llamada al API para obtener los reddits
                axios.get('http://localhost:8000/api/reddits')
                    .then(response => {
                        const reddits = response.data.reddits;

                        // Verificar si hay datos
                        if (reddits && reddits.length > 0) {
                            reddits.forEach(reddit => {
                                
                                // Tarjeta clickeable
                                const card = document.createElement('a');
                                card.href = '#';
                                card.classList.add('card', 'mb-3', 'text-decoration-none');
                                card.style.cursor = 'pointer';
                                card.dataset.id = reddit.id;
                                card.innerHTML = `
                                    <div class="card-body" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                        <h5 class="card-title">${reddit.title}</h5>
                                        <p class="card-text">${reddit.name}</p>
                                        <img src="${reddit.image_url}" alt="${reddit.name}" class="img-fluid rounded">
                                    </div>
                                `;

                                // Añadir el evento de clic para cargar subreddits
                                card.addEventListener('click', function (e) {
                                    e.preventDefault();

                                    const redditId = this.dataset.id;

                                    // Llamada al API para obtener los subreddits del reddit seleccionado
                                    axios.get(`http://localhost:8000/api/reddits/${redditId}`)
                                        .then(response => {
                                            const subreddits = response.data.reddits;

                                            // Se limpia el contenedor de subreddits
                                            subredditsContainer.innerHTML = '<h4 class="text-center">Subreddits</h4>';

                                            // Verificar si el reddit existe
                                            if (subreddits) {
                                                // Crear y mostrar la tarjeta con los datos del reddit seleccionado
                                                const redditItem = document.createElement('div');
                                                redditItem.classList.add('card', 'mb-3');
                                                redditItem.innerHTML = `
                                                    <img src="${subreddits.banner_img}" class="card-img-top" alt="${subreddits.display_name}">
                                                    <div class="card-body" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                        <h5 class="card-title">${subreddits.display_name}</h5>
                                                        <p class="card-text">${subreddits.submit_text_html}</p>
                                                        <p class="card-text"><strong>Subscribers:</strong> ${subreddits.subscribers}</p>
                                                    </div>
                                                `;
                                                subredditsContainer.appendChild(redditItem);
                                            } else {
                                                // Si no existe el reddit, mostrar un mensaje de error
                                                subredditsContainer.innerHTML = '<p>No se encontraron detalles para este Reddit.</p>';
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error al cargar los subreddits:', error);
                                            subredditsContainer.innerHTML = `<p>Error al cargar los subreddits.</p>`;
                                        });
                                });

                                // Añadir la tarjeta al contenedor de reddits
                                redditsContainer.appendChild(card);
                            });
                        } else {
                            redditsContainer.innerHTML = '<p>No se encontraron reddits.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar los reddits:', error);
                        redditsContainer.innerHTML = '<p>Error al cargar los datos.</p>';
                    });
            });
        </script>
    </body>
</html>
