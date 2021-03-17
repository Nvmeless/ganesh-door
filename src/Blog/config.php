<?php 
use App\Blog\BlogModule;
use function \DI\{object, get};

return [
    'blog.prefix' => '/blog',\App\Blog\BlogModule::class => object()->constructorParameter('prefix', get('blog.prefix'))
];