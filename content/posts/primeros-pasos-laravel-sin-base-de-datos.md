---
title: "Primeros pasos con Laravel sin base de datos"
date: "2026-09-20"
category: "Desarrollo"
summary: "Ideas para construir sitios Laravel ligeros usando archivos Markdown y JSON."
tags:
  - Laravel
  - Markdown
  - JSON
draft: false
canonical_url: null
---

## Por que usar archivos

Un sitio personal no siempre necesita una base de datos. Para contenido controlado por el autor, Markdown y JSON pueden ser suficientes.

## Estructura recomendada

Separar el contenido de la presentacion ayuda a mantener el proyecto simple:

```php
content/posts
data/projects.json
app/Services
```

## Ventajas

- Menos infraestructura.
- Versionado directo con Git.
- Despliegue mas sencillo en hosting compartido.
