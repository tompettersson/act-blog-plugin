# Data Associations in Shopware 6

## One to One Associations
Requires a foreign key in one of the tables. Example:

```php
// In BarDefinition
protected function defineFields(): FieldCollection
{
    return new FieldCollection([
        (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
        (new FkField('foo_id', 'fooId', FooDefinition::class))->addFlags(new Required()),
        new OneToOneAssociationField('foo', 'foo_id', 'id', FooDefinition::class, false)
    ]);
}

// In FooDefinition
protected function defineFields(): FieldCollection
{
    return new FieldCollection([
        (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
        new OneToOneAssociationField('bar', 'id', 'foo_id', BarDefinition::class, false)
    ]);
}
```

## One to Many / Many to One
Foreign key needed on "Many" side. Example:

```php
// In BarDefinition (One side)
protected function defineFields(): FieldCollection
{
    return new FieldCollection([
        (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
        new OneToManyAssociationField('foos', FooDefinition::class, 'bar_id')
    ]);
}

// In FooDefinition (Many side)
protected function defineFields(): FieldCollection
{
    return new FieldCollection([
        (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
        (new FkField('bar_id', 'barId', BarDefinition::class))->addFlags(new Required()),
        new ManyToOneAssociationField('bar', 'bar_id', BarDefinition::class, 'id')
    ]);
}
```

## Many to Many
Requires a mapping definition. Example:

```php
// Mapping Definition
class FooBarMappingDefinition extends MappingEntityDefinition
{
    public const ENTITY_NAME = 'foo_bar';

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('bar_id', 'barId', BarDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('foo_id', 'fooId', FooDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            new ManyToOneAssociationField('bar', 'bar_id', BarDefinition::class, 'id'),
            new ManyToOneAssociationField('foo', 'foo_id', FooDefinition::class, 'id')
        ]);
    }
}

// In both main definitions
new ManyToManyAssociationField(
    'propertyName',
    ReferenceDefinition::class,
    MappingDefinition::class,
    'local_id_column',
    'reference_id_column'
)
```
