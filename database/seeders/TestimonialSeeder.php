<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\Article;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $articles = Article::pluck('id')->toArray();

        $rows = [
            ['author_name' => 'Aïcha', 'content' => "Des articles clairs qui m'ont aidée à mieux comprendre mes analyses.", 'rating' => 5],
            ['author_name' => 'Yann', 'content' => "Très pédagogique, j'ai changé mes habitudes grâce aux conseils.", 'rating' => 5],
            ['author_name' => 'Mariam', 'content' => "Simple et fiable, parfait pour expliquer à ma famille.", 'rating' => 4],
            ['author_name' => 'Lucas', 'content' => "Le blog m'a rassuré et orienté vers les bonnes pratiques.", 'rating' => 5],
            ['author_name' => 'Nadia', 'content' => "J'apprécie la clarté et la précision des informations.", 'rating' => 4],
            ['author_name' => 'Omar', 'content' => "Super ressource, accessible et bien structurée.", 'rating' => 5],
        ];

        foreach ($rows as $row) {
            $row['approved'] = true;
            $row['article_id'] = !empty($articles) ? $articles[array_rand($articles)] : null;
            Testimonial::create($row);
        }
    }
}
