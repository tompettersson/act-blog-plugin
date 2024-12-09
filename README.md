# ActBlog Plugin for Shopware 6

A comprehensive blog system for Shopware 6 that allows you to create, manage and display blog articles with categories.

## Features

- Blog article management with multilingual support
- Blog category system
- Admin interface for content management
- Storefront display with filtering and search capabilities
- Store API endpoints for headless usage

## Technical Structure

### Plugin Base
- `src/ActBlog.php`: Main plugin class
- `composer.json`: Plugin configuration and dependencies

### Entities
#### Blog Article
- Location: `src/Core/Content/Blog/BlogArticle`
- Main Entity: `BlogArticleEntity`
- Definition: `BlogArticleDefinition`
- Collection: `BlogArticleCollection`
- Translation Entity: `BlogArticleTranslationEntity`
- Fields:
  - id (UUID)
  - active (boolean)
  - title (translated)
  - content (translated)
  - author (string)
  - publishedAt (datetime)
  - categoryId (UUID)
  - createdAt (datetime)
  - updatedAt (datetime)

#### Blog Category
- Location: `src/Core/Content/Blog/BlogCategory`
- Main Entity: `BlogCategoryEntity`
- Definition: `BlogCategoryDefinition`
- Collection: `BlogCategoryCollection`
- Translation Entity: `BlogCategoryTranslationEntity`
- Fields:
  - id (UUID)
  - name (translated)
  - description (translated)
  - createdAt (datetime)
  - updatedAt (datetime)

### Controllers
#### Storefront
- Location: `src/Storefront/Controller`
- `BlogController`: Handles blog page rendering
- Routes:
  - /blog: Overview page
  - /blog/{articleId}: Article detail page
  - /blog/category/{categoryId}: Category listing

#### Store API
- Location: `src/Core/Content/Blog/SalesChannel`
- `BlogRoute`: API endpoints for blog functionality
- Routes:
  - GET /store-api/blog/articles: List articles
  - GET /store-api/blog/articles/{articleId}: Get single article
  - GET /store-api/blog/categories: List categories

### Administration
- Location: `src/Resources/app/administration/src`
- Components:
  - Article list and detail views
  - Category management
  - Media handling
- Routes:
  - blog/articles: Article management
  - blog/categories: Category management

### Storefront Resources
- Location: `src/Resources/views/storefront`
- Templates:
  - `page/blog/index.html.twig`: Blog overview
  - `page/blog/detail.html.twig`: Article detail
  - `component/blog/`: Reusable components

### JavaScript Plugins
- Location: `src/Resources/app/storefront/src/js`
- `blog-filter.plugin.js`: Handling article filtering
- `blog-search.plugin.js`: Search functionality

### Database
- Location: `src/Migration`
- Tables:
  - `act_blog_article`
  - `act_blog_article_translation`
  - `act_blog_category`
  - `act_blog_category_translation`

## Installation

1. Clone this repository into custom/plugins/ActBlog
2. Install the plugin: `bin/console plugin:install ActBlog`
3. Activate the plugin: `bin/console plugin:activate ActBlog`
4. Clear the cache: `bin/console cache:clear`
5. Install assets: `bin/console assets:install`

## Development

### Requirements
- Shopware 6.6.0 or higher
- PHP 8.1 or higher

### Building the Administration
```bash
cd custom/plugins/ActBlog/src/Resources/app/administration
npm install
npm run build
```

### Building the Storefront
```bash
cd custom/plugins/ActBlog/src/Resources/app/storefront
npm install
npm run build
```

## License

MIT License - See LICENSE file for details
