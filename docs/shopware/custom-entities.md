# Custom Entities in Shopware 6

## Overview
In addition to Custom fields, you can create completely own entities in the system, named custom entities. Unlike Custom fields, you can generate completely custom data structures with custom relations, which can then be maintained by the admin.

## Basic Structure
```xml
<?xml version="1.0" encoding="utf-8" ?>
<entities xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="https://raw.githubusercontent.com/shopware/shopware/trunk/src/Core/System/CustomEntity/Xml/entity-1.0.xsd">
    <entity name="custom_entity_bundle">
        <fields>
            <string name="name" required="true" translatable="true" store-api-aware="true" />
            <price name="discount" required="true" store-api-aware="true"/>
            <many-to-many name="products" reference="product" store-api-aware="true" />
        </fields>
    </entity>
</entities>
```

## Functionality
- Automatically registered repository
- Available in App scripts
- Accessible via Admin API

### Repository Usage Example
```twig
{% set blogs = services.repository.search('custom_entity_blog', criteria) %}
```

### API Access
```http
POST /api/search/custom-entity-blog
```

## Custom Fields Integration
Available since Shopware 6.5.1.0

### Entity Definition with Custom Fields
```xml
<entity name="custom_entity_bundle" custom-fields-aware="true" label-property="name">
    <fields>
        <string name="name" required="true" translatable="true" store-api-aware="true" />
        <price name="discount" required="true" store-api-aware="true"/>
        <many-to-many name="products" reference="product" store-api-aware="true" />
    </fields>
</entity>
```

### Custom Field Labels
```json
{
  "custom_entity_bundle": {
    "label": "My Custom Entity"
  }
}
```

## Permissions
Apps have full access rights to their own custom entities. Additional permissions needed only for core table associations.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<manifest xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <permissions>
        <read>product</read>
    </permissions>
</manifest>
```

## Shorthand Prefix
Since v6.4.15.0, you can use the `ce_` shorthand prefix:

```xml
<entity name="ce_bundle">
    <fields>
        ...
    </fields>
</entity>
```

### Usage with Shorthand
```twig
{% set blogs = services.repository.search('ce_blog', criteria) %}
```

```http
POST /api/search/ce_blog
```
