<?php
namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;
use Livewire\Attributes\Url;

class ShowBlog extends Component
{
    #[Url]
    public $categorySlug = null;

    #[Url]
    public $tagSlug = null;

    public function render()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $paginate = 10;


        $query = Article::orderBy('created_at', 'desc');

        if (!empty($this->categorySlug)) {
            $category = Category::where('slug', $this->categorySlug)->first();

            if (empty($category)) {
                abort(404);
            }

            $query->where('category_id', $category->id);
        }

        if (!empty($this->tagSlug)) {
            $tag = Tag::where('slug', $this->tagSlug)->first();

            if (empty($tag)) {
                abort(404);
            }

            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag_id', $tag->id);
            });
        }

        $articles = $query->paginate($paginate);
        $latestArticles = Article::orderBy('created_at', 'desc')->take(3)->get();

        return view('livewire.show-blog', [
            'articles' => $articles,
            'tags' => $tags,
            'categories' => $categories,
            'latestArticles' => $latestArticles,
        ]);
    }
}
