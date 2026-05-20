# Sshelf

> [!IMPORTANT]
> **Sshelf is currently in Public Beta (v0.1.0-beta).** While core features like the encrypted vault and terminal are functional, you may encounter bugs. We recommend backing up your `APP_KEY` and testing in a safe environment.

Sshelf (Secure Shelf) is a secure SSH credential manager and real-time web terminal built with Laravel 13, Livewire 3, and xterm.js. It allows you to manage multiple server credentials securely and access them directly from your browser.

## Features

- **Encrypted Vault**: Server credentials (passwords/private keys) are encrypted at rest using industry-standard AES-256-GCM.
- **Web Terminal**: High-performance interactive terminal powered by xterm.js and Laravel Reverb.
- **Audit Trails**: Detailed UI for viewing connection history, including IP addresses, timestamps, and session durations.
- **Organization**: Group servers with smart tags and search for easy management.
- **Mobile Friendly**: Fully responsive design with card views optimized for small screens.
- **Import/Export**: Easily migrate data via JSON, CSV, or standard SSH config files.

## Deployment

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/template/deploy?repo=https://github.com/syofyanzuhad/sshelf)

### Self-Hosting (Docker)

Sshelf is optimized for self-hosting using **FrankenPHP**. The simplest way to deploy is using Docker Compose:

1. Clone the repository and enter the directory.
2. Create your `.env` file:
   ```bash
   cp .env.example .env
   ```
3. Generate an application key:
   ```bash
   docker run --rm -v $(pwd):/app php:8.3-cli php /app/artisan key:generate --show
   ```
   Paste this key into your `.env` as `APP_KEY`.
4. Start the stack:
   ```bash
   docker-compose up -d
   ```
Sshelf will be available at `http://localhost:8080`.

## Sponsorship & Support

Sshelf is open-source and free to use. If you find it useful and want to support its continued development, please consider sponsoring the project:

[![Support me on Ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/syofyanzuhad)

Your support helps cover hosting costs and keeps the project alive!

## Configuration

- **Encryption**: Keep your `APP_KEY` safe. If lost, you will lose access to all stored server passwords.
- **Background Worker**: Sshelf uses a background process for the terminal. Ensure `PHP_BINARY_PATH` in your `.env` points to your CLI PHP binary.
- **Reverb**: Real-time communication is handled by Laravel Reverb. Ensure your firewall allows WebSocket traffic on the configured port.

## Installation (Manual)

1. Clone the repository:
   ```bash
   git clone https://github.com/syofyanzuhad/sshelf.git
   cd sshelf
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run migrations:
   ```bash
   php artisan migrate
   ```

5. Build assets:
   ```bash
   npm run build
   ```

## Development

Start the development servers:

```bash
php artisan reverb:start
npm run dev
```

## Security

Sshelf is designed with security in mind:
- **Authorization**: Strict Laravel Policies ensure users only access their own servers.
- **Privacy**: Terminal sessions are broadcast over private, authenticated WebSocket channels.
- **Audit**: Every access attempt is logged for complete transparency.

## License

The Sshelf project is open-source software licensed under the [MIT license](LICENSE).
