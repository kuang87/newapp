<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('home'));
});

// Home > Shop
Breadcrumbs::for('shop', function ($trail) {
    $trail->parent('home');
    $trail->push('Каталог', route('shop'));
});

// Home > Salesl
Breadcrumbs::for('sales', function ($trail) {
    $trail->parent('home');
    $trail->push('Акции', route('product.sales'));
});

// Home > Shop > Cart
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('shop');
    $trail->push('Корзина', route('cart'));
});

// Home > Shop > Category
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('shop');
    $trail->push($category->name, route('product.category', $category->id));
});

//
//// Home > Blog > [Category]
//Breadcrumbs::for('category', function ($trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category->id));
//});
//
//// Home > Blog > [Category] > [Post]
//Breadcrumbs::for('post', function ($trail, $post) {
//    $trail->parent('category', $post->category);
//    $trail->push($post->title, route('post', $post->id));
//});
