# Sshelf (LaraSHH)

Sshelf is a secure SSH credential manager and real-time web terminal built with Laravel 13, Livewire 3, and xterm.js. It allows you to manage multiple server credentials securely and access them directly from your browser.

## Features

- **Encrypted Storage**: Server credentials (passwords/private keys) are encrypted at rest using Laravel's application key.
- **Web Terminal**: High-performance interactive terminal powered by xterm.js and Laravel Reverb.
- **Audit Logging**: Comprehensive logs of every connection attempt, including IP addresses, user agents, and session duration.
- **Organization**: Group servers with tags and folders for easy management.
- **Import/Export**: Easily migrate data via JSON, CSV, or standard SSH config files.

## Prerequisites

- PHP 8.3+
- Node.js & NPM
- Laravel Reverb (for real-time terminal output)
- Redis or a supported Cache driver

## Installation

1. Clone the repository:
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
