<?php

return [
    'pages' => [
        400 => ['title' => 'ERROR 400 - BAD REQUEST', 'description' => 'La solicitud no se pudo procesar correctamente.'],
        401 => ['title' => 'ERROR 401 - UNAUTHORIZED', 'description' => 'Necesitas autorizacion para acceder a este recurso.'],
        403 => ['title' => 'ERROR 403 - FORBIDDEN', 'description' => 'No tienes permiso para acceder a esta pagina.'],
        404 => ['title' => 'ERROR 404 - NOT FOUND', 'description' => 'La pagina que buscas no existe o fue movida.'],
        405 => ['title' => 'ERROR 405 - METHOD NOT ALLOWED', 'description' => 'El metodo usado no esta permitido para esta ruta.'],
        429 => ['title' => 'ERROR 429 - TOO MANY REQUESTS', 'description' => 'Has realizado demasiadas solicitudes. Intentalo de nuevo mas tarde.'],
        500 => ['title' => 'ERROR 500 - INTERNAL SERVER ERROR', 'description' => 'Ocurrio un error interno. Estamos revisandolo.'],
        503 => ['title' => 'ERROR 503 - SERVICE UNAVAILABLE', 'description' => 'KaredIt esta en mantenimiento. Volvemos pronto.'],
    ],
];
