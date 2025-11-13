<?php

require __DIR__ . '/vendor/autoload.php';

echo view('index', [
    'title' => 'Blade Index Page',
    'greeting' => 'This is a Blade Index Page',
    'description' => 'An index page is the main entry point to a website, often called a homepage or landing page, that serves as the primary gateway for visitors. <br>It provides an overview of the site\'s content and includes navigation to guide users to other pages. <br>On the web, the index page is also the default page that loads when someone visits a website without specifying a particular page, <br>with path <b>/app/views/index.blade.php</b> being the most common default name for this file.',
]);

