# Plugin Lifecycle Methods in Shopware 6

## Overview
A Shopware plugin has several lifecycle states: installation, activation, deactivation, and uninstallation. Each state has corresponding methods that can be implemented.

## Lifecycle Methods

### Install
Executed when plugin is installed. Used for setting up plugin requirements.
```php
public function install(InstallContext $installContext): void
{
    // Do stuff such as creating a new payment method
}
```

### Uninstall
Executed when plugin is uninstalled. Used for cleanup.
```php
public function uninstall(UninstallContext $uninstallContext): void
{
    parent::uninstall($uninstallContext);

    if ($uninstallContext->keepUserData()) {
        return;
    }
    // Remove or deactivate plugin data
}
```

### Activate
Executed when plugin is activated. Used for activating entities or creating new data.
```php
public function activate(ActivateContext $activateContext): void
{
    // Activate entities or create new entities
}
```

### Deactivate
Executed when plugin is deactivated. Should reverse activate actions.
```php
public function deactivate(DeactivateContext $deactivateContext): void
{
    // Deactivate entities or remove created entities
}
```

### Update
Executed during plugin updates. Used for non-database updates.
```php
public function update(UpdateContext $updateContext): void
{
    // Update necessary stuff, mostly non-database related
}
```

### Post Methods
Executed after successful installation or update:
```php
public function postInstall(InstallContext $installContext): void
{
    // Post-installation tasks
}

public function postUpdate(UpdateContext $updateContext): void
{
    // Post-update tasks
}
```

## Context Information
All lifecycle methods provide access to:
- Current plugin version
- Current Shopware version
- System context (language, etc.)
- Migration collection
- Auto-migrate settings

## Important Notes
- Install method: Only create data that can be activated/deactivated
- Uninstall method: Be careful with data removal
- Use keepUserData() check in uninstall
- Database updates should use migrations, not update method
