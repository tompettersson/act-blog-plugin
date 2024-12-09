<?php declare(strict_types=1);

namespace Act\Core\Content\BlogArticle;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void add(BlogArticleEntity $entity)
 * @method void set(string $key, BlogArticleEntity $entity)
 * @method BlogArticleEntity[] getIterator()
 * @method BlogArticleEntity[] getElements()
 * @method BlogArticleEntity|null get(string $key)
 * @method BlogArticleEntity|null first()
 * @method BlogArticleEntity|null last()
 */
class BlogArticleCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return BlogArticleEntity::class;
    }
}
