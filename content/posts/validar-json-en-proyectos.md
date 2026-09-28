---
title: "Validar JSON para proyectos personales"
date: "2026-09-10"
category: "Tutoriales"
summary: "Una nota practica para revisar campos obligatorios y URLs en archivos JSON."
tags:
  - JSON
  - Validacion
  - Proyectos
draft: false
canonical_url: null
---

## Campos obligatorios

Cuando un archivo JSON alimenta una vista publica, conviene validar sus campos antes de renderizar.

## Ejemplo

```json
{
  "name": "Proyecto",
  "description": "Descripcion breve",
  "technologies": ["PHP"],
  "year": 2026,
  "github_url": "https://github.com/usuario/proyecto"
}
```

## Resultado

Una validacion temprana evita tarjetas incompletas y errores dificiles de rastrear.
