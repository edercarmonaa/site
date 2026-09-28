# KaredIt

KaredIt es el portafolio, blog tecnico y repositorio de guias de Eder Carmona. El proyecto usa Laravel 11, PHP 8.3, Blade, Tailwind CSS por CDN, Prism.js, Markdown y JSON, sin base de datos ni npm como requisito de produccion.

## Caracteristicas

- Portafolio personal en espanol.
- Blog Markdown con front matter, categorias, tags, TOC, tiempo de lectura y SEO.
- Proyectos desde `data/projects.json`.
- Modo claro/oscuro con preferencia persistente.
- Errores personalizados, sitemap, robots, manifest y headers de seguridad.
- Validaciones con Pint, PHPStan/Larastan, PHPUnit y reporte `TEST_REPORT.md`.

## Requisitos

- PHP 8.3
- Composer
- Extensiones PHP habituales de Laravel

## Instalacion

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Para desarrollo local opcional:

```bash
php artisan serve
```

URL local con Artisan: `http://127.0.0.1:8000`

En un servidor con Apache o Nginx, no se usa `php artisan serve`. El servidor web debe apuntar el document root a `public/` y exponer el sitio por el puerto configurado del servidor, normalmente `80` para HTTP y `443` para HTTPS.

En cPanel/hosting compartido, si el dominio apunta al root del repositorio y aparece `ERROR 403 - FORBIDDEN`, significa que Apache no esta entrando a `public/index.php`. La configuracion recomendada es cambiar el document root del dominio a:

```text
/ruta/del/proyecto/public
```

Si el hosting no permite cambiar el document root, el proyecto incluye un `index.php` y `.htaccess` en la raiz como fallback para redirigir las solicitudes hacia `public/` y bloquear carpetas internas.

## Configuracion inicial

Edita `.env` con valores locales seguros. No se configura base de datos. La informacion del sitio vive en `config/site.php`, `config/blog.php`, `config/projects.php` y `config/errors.php`.

## Estructura del proyecto

- `app/Services`: lectura y validacion de contenido.
- `content/posts`: publicaciones Markdown.
- `data/projects.json`: proyectos.
- `resources/views`: vistas Blade y componentes.
- `public/assets`: imagenes, CSS y JS sin build step.
- `scripts`: verificacion y generacion de reportes.

## Gestion de contenido

Cada post usa el nombre del archivo como slug. Ejemplo: `content/posts/instalar-ssh-debian.md` genera `/blog/instalar-ssh-debian`.

Front matter listo para copiar:

```yaml
---
title: "Instalar y habilitar SSH en Debian"
date: "2026-09-28"
category: "Linux"
summary: "Guia para instalar y habilitar OpenSSH Server en Debian."
tags:
  - Debian
  - SSH
  - Linux
draft: false
canonical_url: null
---
```

Campos obligatorios: `title`, `date`, `category`, `summary`, `tags`. Campos opcionales: `draft`, `canonical_url`. La fecha debe usar `YYYY-MM-DD`. Las categorias iniciales son Linux, Desarrollo, Bases de datos y Tutoriales. Los tags son libres.

En produccion, posts con `draft: true` o fecha futura se ocultan. En local/testing se muestran con etiqueta.

## Tests y calidad

```bash
./vendor/bin/pint
./vendor/bin/phpstan analyse
composer check
composer format
composer report
```

`composer check` ejecuta Pint en modo check, PHPStan, PHPUnit y genera `TEST_REPORT.md`. `composer report` reutiliza los resultados guardados en `storage/app/test-results/`.

## Git workflow

- Principal: `main`
- Integracion: `develop`
- Features: `feature/nombre`
- Hotfix: `hotfix/nombre`

Versionado SemVer: `MAJOR.MINOR.PATCH`. Tags: `v1.0.0`, `v1.1.0`, `v1.1.1`.

## Troubleshooting

- Cache: ejecuta `php artisan optimize:clear`.
- Cache de contenido: ejecuta `php artisan karedit:clear-content-cache`.
- Permisos: revisa escritura en `storage/` y `bootstrap/cache/`.
- Post que no aparece: valida slug, front matter y extension `.md`.
- Drafts: en produccion `draft: true` no se publica.
- Fecha futura: en produccion se oculta hasta la fecha indicada.
- Categoria incorrecta: debe existir en `config/blog.php`.
- `.env`: confirma `APP_URL`, `APP_ENV` y `APP_KEY`.
- Proyectos JSON invalidos: valida `data/projects.json` y los campos obligatorios.

## Seguridad

Los reportes de vulnerabilidad se reciben en `edercarmona@karedit.com.mx`. No versionar credenciales, secrets, tokens, llaves privadas ni artefactos locales.

## Licencia

MIT.

## Checklist de release

1. Ejecutar `composer check`.
2. Revisar `TEST_REPORT.md`.
3. Resolver fallos.
4. Revisar `CHANGELOG.md`.
5. Actualizar `VERSION`.
6. Validar SemVer.
7. Crear tag `vX.Y.Z`.
