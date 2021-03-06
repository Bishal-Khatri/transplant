<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPage extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(MenuPage::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function children()
    {
        return $this->hasMany(MenuPage::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function getLink()
    {
        switch ($this->type){
            case 'url':
                $link = $this->url;
                break;
            case 'page':
                $link = $this->getPageLink();
                break;
            case 'category':
                $link = $this->getCategoryLink();
                break;
            default:
                $link = '/link-broken';
        }

        return $link;
    }

    public function getPageLink()
    {
        return route('get-page', $this->slug);
    }

    public function getCategoryLink()
    {
        return route('get-category', $this->slug);
    }

//    public function menu()
//    {
//        return $this->belongsTo(Menu::class, 'menu_id');
//    }

//    public function category()
//    {
//        return $this->belongsTo(Category::class, 'category_id');
//    }

//    public function page()
//    {
//        return $this->belongsTo(Page::class, 'page_id');
//    }
}
