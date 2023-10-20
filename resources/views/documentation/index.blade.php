<!DOCTYPE html>
<html>
<head>
    <title>Swagger UI</title>
    <link rel="stylesheet" href="{{ asset('larawater/swagger/css/swagger-ui.css') }}">
</head>
<body>
    <div id="swagger-ui"></div>
</body>
<footer>
    <script src="{{ asset('larawater/swagger/js/swagger-ui-bundle.js') }}"></script>
    <script>
        window.onload = function() {
            const ui = SwaggerUIBundle({
                url: "{{ $rawDocumentation }}",
                dom_id: '#swagger-ui',
            });
        }
    </script>
</footer>
</html>
