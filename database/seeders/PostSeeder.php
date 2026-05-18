<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Claps;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            'Technology',
            'Design',
            'Business',
            'Culture',
            'Writing',
            'Health',
            'Science',
        ])->mapWithKeys(fn (string $name) => [
            $name => Category::query()->updateOrCreate(['name' => $name]),
        ]);

        $authors = collect([
            [
                'name' => 'Maya Chen',
                'username' => 'maya-chen',
                'email' => 'maya@example.com',
                'bio' => 'Product designer writing about calm interfaces, better teams, and the small decisions behind useful software.',
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=256&q=80',
            ],
            [
                'name' => 'Noah Carter',
                'username' => 'noah-carter',
                'email' => 'noah@example.com',
                'bio' => 'Full-stack developer exploring Laravel, product thinking, and the craft of shipping thoughtful web apps.',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=256&q=80',
            ],
            [
                'name' => 'Ariana Stone',
                'username' => 'ariana-stone',
                'email' => 'ariana@example.com',
                'bio' => 'Writer and strategist interested in creative habits, modern work, and practical storytelling.',
                'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=256&q=80',
            ],
        ])->mapWithKeys(fn (array $author) => [
            $author['username'] => User::query()->updateOrCreate(
                ['email' => $author['email']],
                [
                    'name' => $author['name'],
                    'username' => $author['username'],
                    'bio' => $author['bio'],
                    'image' => $author['image'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ],
            ),
        ]);

        $posts = [
            [
                'author' => 'maya-chen',
                'category' => 'Design',
                'title' => 'Designing a Reading Experience That Gets Out of the Way',
                'image' => 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=1400&q=80',
                'published_at' => now()->subDays(2),
                'content' => <<<'TEXT'
The best reading interfaces feel almost invisible. They do not compete with the article, ask for attention every few seconds, or turn every interaction into a decision.

For this project, the goal is simple: give the story enough space, keep navigation predictable, and make the important actions easy to find without making them loud. A good feed should help readers scan quickly. A good article page should slow them down in the best way.

That means fewer boxes, fewer shadows, stronger typography, and a rhythm that feels calm on both mobile and desktop. The interface should make the writer look credible before the reader has even finished the first paragraph.
TEXT,
            ],
            [
                'author' => 'noah-carter',
                'category' => 'Technology',
                'title' => 'What I Learned Building a Medium Clone With Laravel',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1400&q=80',
                'published_at' => now()->subDays(4),
                'content' => <<<'TEXT'
Building a publishing app looks straightforward until the small product details begin to show up. A post is not just a title and body. It has an author, a public URL, a topic, a cover image, a read time, and a set of interactions that need to feel instant.

Laravel is a strong fit for this kind of project because the boring parts are already solved well. Authentication, validation, file storage, routing, factories, tests, and database relationships all have clear conventions.

The trick is to keep those conventions visible. Controllers should stay small, views should not query the database, and the data shown in the UI should be eager-loaded before it reaches Blade.
TEXT,
            ],
            [
                'author' => 'ariana-stone',
                'category' => 'Writing',
                'title' => 'A Simple Framework for Writing Better First Drafts',
                'image' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1400&q=80',
                'published_at' => now()->subDays(6),
                'content' => <<<'TEXT'
The fastest way to improve a first draft is to stop asking it to be a final draft. A good first draft is allowed to be uneven. Its job is to reveal the shape of the idea.

Start with the promise. What should the reader understand, feel, or be able to do by the end? Then write the middle as a sequence of useful steps. Do not decorate the idea before it can stand.

Editing comes later. That is when you remove the throat-clearing, sharpen the examples, and make every paragraph earn its place.
TEXT,
            ],
            [
                'author' => 'maya-chen',
                'category' => 'Business',
                'title' => 'Why Small Product Decisions Build Trust',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1400&q=80',
                'published_at' => now()->subDays(8),
                'content' => <<<'TEXT'
Trust rarely comes from one dramatic feature. More often, it is built through dozens of small product decisions that tell users the team is paying attention.

Clear labels, predictable navigation, fast feedback, readable error messages, and sensible defaults all compound. Each one lowers friction a little. Together they make the product feel reliable.

This matters especially in apps where people create something. Writers need to feel that their work is safe, editable, and presented with care.
TEXT,
            ],
            [
                'author' => 'noah-carter',
                'category' => 'Science',
                'title' => 'The Quiet Power of Systems That Explain Themselves',
                'image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1400&q=80',
                'published_at' => now()->subDays(10),
                'content' => <<<'TEXT'
The best systems do not require a manual for every basic action. Their structure teaches you what is possible, what just happened, and what to do next.

This is true in science, software, and everyday tools. When cause and effect are visible, people build confidence. When the system hides its logic, people hesitate.

A clean interface is not only about aesthetics. It is about helping users form an accurate mental model quickly enough to stay in flow.
TEXT,
            ],
            [
                'author' => 'ariana-stone',
                'category' => 'Culture',
                'title' => 'The Return of Personal Publishing',
                'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1400&q=80',
                'published_at' => now()->subDays(12),
                'content' => <<<'TEXT'
Personal publishing keeps coming back because people want a place that feels like theirs. Social feeds are fast, but they are not always kind to depth.

A publishing platform gives ideas a little more room. It lets a writer build a body of work, not just a stream of updates. It lets readers find a voice and return to it.

That is why simple writing tools still matter. They create a quieter space for thinking in public.
TEXT,
            ],
            [
                'author' => 'maya-chen',
                'category' => 'Health',
                'title' => 'Designing Workflows That Respect Attention',
                'image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1400&q=80',
                'published_at' => now()->subDays(14),
                'content' => <<<'TEXT'
Attention is not an unlimited resource. Every extra prompt, tab, badge, and unnecessary choice asks the user to spend a little more of it.

Respectful workflows reduce that cost. They group related actions, remove duplicate paths, and make the next step obvious. They also know when to stop asking for input.

When software respects attention, it starts to feel lighter. People can focus on the work they came to do instead of managing the tool itself.
TEXT,
            ],
            [
                'author' => 'noah-carter',
                'category' => 'Technology',
                'title' => 'Making Demo Data Feel Real',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1400&q=80',
                'published_at' => now()->subDays(16),
                'content' => <<<'TEXT'
Demo data is part of the product experience. Empty screens are useful for testing, but a portfolio project needs enough content to show the interface under real pressure.

Good seed data has names, relationships, categories, dates, and images that make the app feel alive. It should show the best version of the product without pretending to be production data.

The goal is not volume. The goal is believability. A handful of thoughtful posts can communicate more than a hundred generic rows.
TEXT,
            ],
        ];

        foreach ($posts as $index => $data) {
            $post = Post::query()->updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'category_id' => $categories[$data['category']]->id,
                    'user_id' => $authors[$data['author']]->id,
                    'published_at' => $data['published_at'],
                    'created_at' => Carbon::parse($data['published_at']),
                    'updated_at' => Carbon::parse($data['published_at'])->addHours(2),
                ],
            );

            $post->forceFill(['image' => $data['image']])->save();

            $clappers = $authors
                ->reject(fn (User $author) => $author->is($authors[$data['author']]))
                ->take(($index % 2) + 1);

            foreach ($clappers as $clapper) {
                Claps::query()->firstOrCreate([
                    'post_id' => $post->id,
                    'user_id' => $clapper->id,
                ]);
            }
        }

        $authors['maya-chen']->followers()->syncWithoutDetaching([
            $authors['noah-carter']->id,
            $authors['ariana-stone']->id,
        ]);

        $authors['noah-carter']->followers()->syncWithoutDetaching([
            $authors['maya-chen']->id,
        ]);
    }
}
