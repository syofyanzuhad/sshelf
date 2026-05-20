# Sshelf

Sshelf is a secure SSH credential manager and real-time web terminal built with Laravel 13, Livewire 3, and xterm.js. It allows you to manage multiple server credentials securely and access them directly from your browser.
## Features

- **Encrypted Storage**: Server credentials (passwords/private keys) are encrypted at rest using Laravel's application key.
- **Web Terminal**: High-performance interactive terminal powered by xterm.js and Laravel Reverb.
- **Audit Logging**: Comprehensive logs of every connection attempt, including IP addresses, user agents, and session duration.
- **Organization**: Group servers with tags and folders for easy management.
- **Import/Export**: Easily migrate data via JSON, CSV, or standard SSH config files.

## Deployment

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/template/deploy?repo=https://github.com/syofyanzuhad/sshelf)

### Self-Hosting (Docker)

Sshelf is designed to be easily self-hosted. The simplest way is using Docker Compose:

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

### Configuration

- **Encryption**: Make sure to keep your `APP_KEY` safe. If lost, you will lose access to all stored server passwords.
- **Background Worker**: Sshelf uses a background PHP process for the web terminal. If your terminal isn't connecting, ensure `PHP_BINARY_PATH` in your `.env` points to your CLI PHP binary (especially on macOS with Herd).

## Installation (Manual)

1. Clone the repository:
...
   ```bash
   git clone https://github.com/sshelf/sshelf.git
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
- **Audit**: All access is tracked in the `connection_logs` table.

## License

The Sshelf project is open-source software licensed under the [MIT license](LICENSE).
