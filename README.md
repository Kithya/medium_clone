# Medium Clone

A simple Medium-inspired blogging app built with Laravel. Users can create posts, upload cover images, browse by category, clap for posts, follow writers, and view public profiles.

## Features

- User registration, login, logout, and profile management
- Create, edit, and delete your own posts
- Upload post cover images with Spatie Media Library
- Automatic post slugs generated from titles
- Category tabs for filtering posts
- Public writer profile pages at `/@username`
- Follow and unfollow writers
- Clap and unclap posts
- Paginated post feeds
- Responsive Blade views styled with Tailwind CSS

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Authentication:** Laravel Breeze
- **Frontend:** Blade, Tailwind CSS, Alpine.js, Vite
- **Database:** Laravel migrations and Eloquent ORM
- **Media:** Spatie Laravel Media Library
- **Slugs:** Spatie Laravel Sluggable
- **Testing:** Pest

## Requirements

Make sure these are installed before running the project:

- PHP 8.2 or higher
- Composer
- Node.js and npm
- A database supported by Laravel, such as SQLite, MySQL, or PostgreSQL

## Installation

1. Clone the project and enter the folder:

```bash
git clone <repository-url>
cd medium-clone
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install JavaScript dependencies:

```bash
npm install
```

4. Create the environment file:

```bash
cp .env.example .env
```

On Windows PowerShell, use:

```powershell
Copy-Item .env.example .env
```

5. Generate the app key:

```bash
php artisan key:generate
```

6. Configure your database in `.env`.

For SQLite, create the database file if it does not exist:

```bash
touch database/database.sqlite
```

On Windows PowerShell, use:

```powershell
New-Item database/database.sqlite -ItemType File
```

Then set your `.env` database values, for example:

```env
DB_CONNECTION=sqlite
```

7. Run migrations and seed the default categories:

```bash
php artisan migrate --seed
```

8. Create the storage symlink for uploaded images:

```bash
php artisan storage:link
```

## Running The App

Start the Laravel server:

```bash
php artisan serve
```

In another terminal, start Vite:

```bash
npm run dev
```

Open the app at:

```text
http://127.0.0.1:8000
```

You can also run the combined development command from `composer.json`:

```bash
composer run dev
```

## Useful Commands

```bash
php artisan migrate
php artisan migrate:fresh --seed
php artisan test
npm run build
```

## Main Routes

| Route | Description |
| --- | --- |
| `/` | Home feed with latest posts |
| `/category/{category}` | Posts filtered by category |
| `/post/create` | Create a new post |
| `/post/{post:slug}` | Edit your own post |
| `/@{username}/{post:slug}` | Public post detail page |
| `/@{username}` | Public writer profile |
| `/my-posts` | Posts created by the logged-in user |
| `/profile` | Account profile settings |

## Project Structure

```text
app/
  Http/Controllers/    Request handling for posts, profiles, follows, and claps
  Http/Requests/       Validation rules for profile and post forms
  Models/              Eloquent models for users, posts, categories, followers, and claps

database/
  migrations/          Database schema
  seeders/             Default category data

resources/
  views/               Blade pages and reusable components
  css/                 Tailwind app stylesheet
  js/                  Alpine and frontend bootstrap files

routes/
  web.php              Main web routes
  auth.php             Authentication routes from Laravel Breeze
```

## Database Notes

The app uses these main tables:

- `users` for account data, profile images, bios, and usernames
- `categories` for post categories
- `posts` for article content, slugs, cover images, and ownership
- `followers` for follow relationships between users
- `claps` for post claps by users
- `media` for uploaded files managed by Spatie Media Library

## Testing

Run the test suite with:

```bash
php artisan test
```

or:

```bash
composer test
```

## Notes

- A user must be logged in to create posts, clap, follow writers, or manage their own content.
- Only the owner of a post can edit or delete it.
- Categories are created by the database seeder.
- Uploaded images are stored through the `public` disk, so `php artisan storage:link` is required for images to display correctly.
