# Entities via Attributes in Shopware 6

## Basic Entity Definition
```php
<?php declare(strict_types=1);

namespace Examples;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\Entity as EntityAttribute;

#[EntityAttribute('example_entity', collectionClass: ExampleEntityCollection::class)]
class ExampleEntity extends Entity
{
    #[PrimaryKey]
    #[Field(type: FieldType::UUID)]
    public string $id;
}
```

## Field Types
Available field types through `FieldType` class:
```php
#[Field(type: FieldType::STRING)]
public string $string;

#[Field(type: FieldType::TEXT)]
public ?string $text = null;

#[Field(type: FieldType::INT)]
public ?int $int;
```

## Special Fields

### AutoIncrement
```php
#[AutoIncrement]
public int $autoIncrement;
```

### Foreign Keys
```php
#[ForeignKey(entity: 'currency')]
public ?string $foreignKey;
```

### JSON Fields
```php
#[Serialized(serializer: PriceFieldSerializer::class)]
public ?PriceCollection $serialized = null;
```

## Translations
```php
#[Field(type: FieldType::STRING, translated: true)]
public ?string $string = null;

/**
 * @var array<string, ArrayEntity>|null
 */
#[Translations]
public ?array $translations = null;
```

## Required Fields
```php
#[Required]
#[Field(type: FieldType::STRING, translated: true)]
public ?string $required = null;
```

## Associations

### One-To-One
```php
#[OneToOne(entity: 'currency')]
public ?CurrencyEntity $follow = null;
```

### One-To-Many
```php
#[OneToMany(entity: 'example_entity_agg', ref: 'example_entity_id')]
public ?array $aggs = null;
```

### Many-To-One
```php
#[ManyToOne(entity: 'currency')]
public ?CurrencyEntity $currency = null;
```

### Many-To-Many
```php
#[ManyToMany(entity: 'currency')]
public ?array $currencies = null;
```

## Entity Collection
```php
<?php declare(strict_types=1);

namespace Examples;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<ExampleEntity>
 */
class ExampleEntityCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return ExampleEntity::class;
    }
}
```

## Registration
Register the entity in services.xml:
```xml
<service id="Your\Namespace\ExampleEntity">
    <tag name="shopware.entity"/>
</service>
```
