<!DOCTYPE html>
<html>
<head>
    <title>Swagger UI</title>
    <script>
        var styleUrl = "{{ $styleUrl }}";

        fetch(styleUrl)
        .then(response => response.text())
        .then(styleContent => {
            var styleElement = document.createElement('style');

            styleElement.type = 'text/css';

            styleElement.innerHTML = styleContent;

            document.head.appendChild(styleElement);
        })
        .catch(error => {
            console.error("Erro ao buscar a folha de estilo:", error);
        });
    </script>
</head>
<body>
    <div id="swagger-ui"></div>
</body>
<footer>
    <script>
        var scriptUrl = "{{ $scriptUrl }}";

        fetch(scriptUrl)
        .then(response => response.text())
        .then(scriptContent => {
            var scriptElement = document.createElement('script');

            scriptElement.type = 'text/javascript';

            scriptElement.innerHTML = scriptContent;

            document.body.appendChild(scriptElement);

            const ui = SwaggerUIBundle({
                url: "{{ $rawDocumentation }}",
                dom_id: '#swagger-ui',
            });
        })
        .catch(error => {
            console.error("Erro ao buscar o script:", error);
            document.body.innerHTML = '<div id="swagger-ui"><div class="swagger-ui"><div class="version-pragma"><div class="version-pragma__message version-pragma__message--missing"><div><h3>Unable to fetch resources</h3></div></div></div></div></div>';
        });
    </script>
</footer>
</html>
