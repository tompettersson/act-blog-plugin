# Database Migrations in Shopware 6

## Overview
Migrations are PHP classes used to manage incremental and reversible database schema changes. Shopware comes with a pre-built Migration System.

## File Structure
Default location for migration files:
```
└── plugins
    └── SwagBasicExample
        └── src
            ├── Migration
            │   └── Migration1546422281ExampleDescription.php
            └── SwagBasicExample.php
```

### File Naming Convention
- Must start with `Migration`
- Followed by timestamp (e.g., 1546422281)
- Ends with descriptive name

## Customizing Migration Path
Can be changed by overwriting plugin's `getMigrationNamespace()`:
```php
public function getMigrationNamespace(): string
{
    return 'Swag\BasicExample\MyMigrationNamespace';
}
```

## Creating Migrations
Command:
```bash
$ ./bin/console database:create-migration -p SwagBasicExample --name ExampleDescription
```

### Migration Structure
```php
class Migration1611740369ExampleDescription extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1611740369;
    }

    public function update(Connection $connection): void
    {
        // implement update
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
```

### Example Migration
```php
public function update(Connection $connection): void
{
    $query = <<<SQL
CREATE TABLE IF NOT EXISTS `swag_basic_example_general_settings` (
    `id`                INT             NOT NULL,
    `example_setting`   VARCHAR(255)    NOT NULL,
    PRIMARY KEY (id)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;
SQL;

    $connection->executeStatement($query);
}
```

## SQL Schema
Generate schema for active entities:
```bash
$ ./bin/console dal:create:schema
```

## Executing Migrations
Commands:
- `database:migrate` - Executes update() methods
- `database:migrate-destructive` - Executes updateDestructive() methods

Example:
```bash
$ ./bin/console database:migrate SwagBasicExample --all
```

## Advanced Migration Control
Control migrations during installation/update:
```php
public function update(UpdateContext $updateContext): void
{
    $updateContext->setAutoMigrate(false); // disable auto migration
    $migrationCollection = $updateContext->getMigrationCollection();
    
    // execute destructive migrations
    $migrationCollection->migrateDestructiveInPlace(1572566400);
    
    // execute update migrations
    $migrationCollection->migrateInPlace(1576143014);
}
```
