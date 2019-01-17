<?php

namespace Tests\Unit;

use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * It Fetches Trending Articles
     *
     */
    public function testItFetchesTrendingArticles()
    {
        // not so popular articles
        factory(Article::class, 3)->create();
        // these are quite popular
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        // Get articles with the most reads at top
        $articles = Article::trending(2);

        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(2, $articles);
    }
}
