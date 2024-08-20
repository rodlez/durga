<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;

use App\Controllers\{HomeController, NewsletterController, AboutController, ContactController, BlogController, ImageController, CategoryController, TagController, AuthController, AdminController, ErrorController};

use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware, AdminRequiredMiddleware};

/**
 * Function to register routes and quit complexity from the bootstrap file, now, we can call it in bootstrap.php 
 */

function registerRoutes(App $app)
{
    // use the class Magic constant instead the whole path 'use App\Controllers\HomeController;' to avoid typos

    // ***************************************** PUBLIC *******************************************************

    // Home Page
    $app->get('/', [HomeController::class, 'home']);
    $app->post('/', [HomeController::class, 'newsletter']);

    // Lang
    $app->get('/lang', [HomeController::class, 'langChange']);

    // Privacy
    $app->get('/privacy', [HomeController::class, 'privacy']);

    // Legal
    $app->get('/legal', [HomeController::class, 'legal']);

    // Cookies
    $app->get('/cookies', [HomeController::class, 'cookies']);

    // Newsletter Page
    $app->get('/newsletter', [NewsletterController::class, 'newsletterOk']);

    // About Page
    $app->get('/about', [AboutController::class, 'about']);

    // Blog Page
    $app->get('/blog', [BlogController::class, 'blogView']);
    $app->get('/blog/{id}', [BlogController::class, 'blogEntryView']);

    // Contacto Page
    $app->get('/contacto', [ContactController::class, 'contactView']);
    $app->post('/contacto', [ContactController::class, 'contact']);
    $app->get('/contacto/ok', [ContactController::class, 'contactOk']);


    // ******* AuthController ********
    // Register Page
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    // Login Page
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    // Logout
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);

    // ***** 404 Error Page *****
    $app->setErrorHandler([ErrorController::class, 'notFound']);

    // ****************************************** ADMIN ********************************************************

    $app->get('/admin', [AdminController::class, 'adminView'])->add(AdminRequiredMiddleware::class);

    // ***** NEWSLETTER *****
    $app->get('/admin/newsletter', [NewsletterController::class, 'newsletterView'])->add(AdminRequiredMiddleware::class);
    // Create
    $app->get('/admin/newsletter/create', [NewsletterController::class, 'createNewsletterView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/newsletter/create', [NewsletterController::class, 'createNewsletterEntry'])->add(AdminRequiredMiddleware::class);
    // Send Newsletter
    $app->get('/admin/newsletter/send', [NewsletterController::class, 'sendNewsletterView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/newsletter/send', [NewsletterController::class, 'sendNewsletter'])->add(AdminRequiredMiddleware::class);
    // Edit
    $app->get('/admin/newsletter/{newsletter}', [NewsletterController::class, 'editNewsletterEntryView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/newsletter/{newsletter}', [NewsletterController::class, 'editNewsletterEntry'])->add(AdminRequiredMiddleware::class);
    // Delete
    $app->delete('/admin/newsletter/{newsletter}', [NewsletterController::class, 'deleteNewsletterEntry'])->add(AdminRequiredMiddleware::class);

    // ***** CONTACT *****
    // Main
    $app->get('/admin/contact', [ContactController::class, 'adminContactView'])->add(AdminRequiredMiddleware::class);
    // Create
    $app->get('/admin/contact/create', [ContactController::class, 'adminCreateContactView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/contact/create', [ContactController::class, 'adminCreateContact'])->add(AdminRequiredMiddleware::class);
    // Read
    $app->get('/admin/contact/{id}', [ContactController::class, 'adminContactInfoView'])->add(AdminRequiredMiddleware::class);
    // Update
    $app->get('/admin/contact/{id}/edit', [ContactController::class, 'adminContactEditView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/contact/{id}/edit', [ContactController::class, 'adminContactEdit'])->add(AdminRequiredMiddleware::class);
    // Delete
    $app->delete('/admin/contact/{id}', [ContactController::class, 'adminContactDelete'])->add(AdminRequiredMiddleware::class);
    // Answer
    $app->get('/admin/contact/{id}/answer', [ContactController::class, 'adminContactAnswerView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/contact/{id}/answer', [ContactController::class, 'adminContactAnswer'])->add(AdminRequiredMiddleware::class);

    // ***** BLOG *****
    // Main
    $app->get('/admin/blog', [BlogController::class, 'adminBlogView'])->add(AdminRequiredMiddleware::class);
    $app->get('/admin/blog/create', [BlogController::class, 'createBlogEntryView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/blog/create', [BlogController::class, 'createBlogEntry'])->add(AdminRequiredMiddleware::class);
    // Blog Show    
    $app->get('/admin/blog/{id}', [BlogController::class, 'infoBlogEntryView'])->add(AuthRequiredMiddleware::class);
    // Blog Publish / UnPublish
    $app->get('/admin/blog/{id}/published/{pub}', [BlogController::class, 'publishBlog'])->add(AuthRequiredMiddleware::class);
    // Blog Image    
    $app->get('/admin/blog/{id}/image', [ImageController::class, 'uploadView'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/blog/{id}/image', [ImageController::class, 'upload'])->add(AuthRequiredMiddleware::class);
    $app->delete('/admin/blog/{id}/image/{imageId}', [ImageController::class, 'delete'])->add(AuthRequiredMiddleware::class);
    // Blog Edit    
    $app->get('/admin/blog/{id}/edit', [BlogController::class, 'editBlogView'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/blog/{id}/edit', [BlogController::class, 'editBlog'])->add(AuthRequiredMiddleware::class);
    // Blog Translate Create    
    $app->get('/admin/blog/{id}/trans', [BlogController::class, 'createBlogTransView'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/blog/{id}/trans', [BlogController::class, 'createBlogTrans'])->add(AuthRequiredMiddleware::class);
    // Blog Translate Show    
    $app->get('/admin/blog/{id}/trans/{transId}', [BlogController::class, 'infoBlogTransView'])->add(AuthRequiredMiddleware::class);
    // Blog Translate Edit    
    $app->get('/admin/blog/{id}/trans/{transId}/edit', [BlogController::class, 'editBlogTransView'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/blog/{id}/trans/{transId}/edit', [BlogController::class, 'editBlogTrans'])->add(AuthRequiredMiddleware::class);
    // Blog Translate Delete    
    $app->delete('/admin/blog/{id}/trans/{transId}', [BlogController::class, 'deleteBlogTrans'])->add(AuthRequiredMiddleware::class);
    // Blog Delete
    $app->delete('/admin/blog/{id}', [BlogController::class, 'deleteBlog'])->add(AdminRequiredMiddleware::class);

    // ***** BLOG CATEGORIES *****
    $app->get('/admin/category', [CategoryController::class, 'categoryView'])->add(AdminRequiredMiddleware::class);
    $app->get('/admin/category/create', [CategoryController::class, 'createCategoryView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/category/create', [CategoryController::class, 'createCategory'])->add(AdminRequiredMiddleware::class);
    $app->get('/admin/category/{category}', [CategoryController::class, 'editCategoryView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/category/{category}', [CategoryController::class, 'editCategory'])->add(AdminRequiredMiddleware::class);
    $app->delete('/admin/category/{category}', [CategoryController::class, 'deleteCategory'])->add(AdminRequiredMiddleware::class);

    // ***** BLOG TAGS *****
    $app->get('/admin/tag', [TagController::class, 'tagView'])->add(AdminRequiredMiddleware::class);
    $app->get('/admin/tag/create', [TagController::class, 'createTagView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/tag/create', [TagController::class, 'createTag'])->add(AdminRequiredMiddleware::class);
    $app->get('/admin/tag/{tag}', [TagController::class, 'editTagView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/tag/{tag}', [TagController::class, 'editTag'])->add(AdminRequiredMiddleware::class);
    $app->delete('/admin/tag/{tag}', [TagController::class, 'deleteTag'])->add(AdminRequiredMiddleware::class);
}
