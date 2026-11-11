# Ibnu — Personal Portfolio

A responsive personal portfolio built with Laravel, Livewire, Blade, and Vite.

## Run locally

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
```

In another terminal, run `php artisan serve` and open the local URL it prints.
If using MySQL, create the database named in `DB_DATABASE` before running migrations; SQLite is also supported by Laravel.

## Editing portfolio content

Edit projects, skill groups and optional skill-level labels, journey items, journal notes, and social/contact links in `config/portfolio.php`. Add skill levels only when you have chosen a truthful label. Project and journal details are available at their own URLs; unknown slugs return 404.

The contact form validates and stores submissions in the `contact_messages` table. Configure a database and run migrations before accepting messages. No email or social account details are assumed.
