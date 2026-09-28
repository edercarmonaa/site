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

## Objetivo

SSH permite administrar un servidor Debian de forma remota y segura. En esta guia se instala el servidor OpenSSH, se habilita el servicio y se revisa su estado.

## Instalacion

Actualiza los repositorios e instala el paquete:

```bash
sudo apt update
sudo apt install openssh-server
```

### Verificar el servicio

Comprueba que el servicio este activo:

```bash
sudo systemctl status ssh
```

## Habilitar al inicio

Para iniciar SSH automaticamente con el sistema:

```bash
sudo systemctl enable ssh
```

## Notas de seguridad

- Usa contrasenas fuertes o autenticacion por llave publica.
- Limita usuarios cuando el servidor sea publico.
- Revisa los logs si detectas intentos de acceso inusuales.

| Comando | Uso |
| --- | --- |
| `systemctl status ssh` | Ver estado |
| `systemctl restart ssh` | Reiniciar servicio |
