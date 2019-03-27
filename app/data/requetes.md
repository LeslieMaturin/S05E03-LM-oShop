# Requetes

## Layout

Les 5 types dans le footer :
```sql
SELECT `name`
FROM `type`
WHERE footer_order > 0
ORDER BY footer_order
LIMIT 5;
```

Les 5 marques dans le footer :
```sql
SELECT `name`
FROM `brand`
WHERE footer_order > 0
ORDER BY footer_order
LIMIT 5;
```

## Home

Les 5 catégories mises en avant :
```sql
SELECT *
FROM `category`
WHERE home_order > 0
ORDER BY home_order
LIMIT 5;
```

## Catégorie

Tous les produits de la catégorie #1 triés par nom croissant :
```sql
SELECT *
FROM `product`
WHERE category_id = 1
ORDER BY name ASC;
```

Tous les produits de la catégorie #1 triés par prix croissant :
```sql
SELECT *
FROM `product`
WHERE category_id = 1
ORDER BY price ASC;
```

## Marques

Tous les produits de la marque #2 triés par nom croissant :
```sql
SELECT *
FROM `product`
WHERE brand_id = 2
ORDER BY name ASC;
```

Tous les produits de la marque #2 triés par prix croissant :
```sql
SELECT *
FROM `product`
WHERE brand_id = 2
ORDER BY price ASC;
```

## Type

Tous les produits du type #3 triés par nom croissant :
```sql
SELECT *
FROM `product`
WHERE type_id = 3
ORDER BY name ASC;
```

Tous les produits du type #3 triés par prix croissant :
```sql
SELECT *
FROM `product`
WHERE type_id = 3
ORDER BY price ASC;
```

## Produit

Les informations sur le produit #1 + nom de la marque + nom de la catégorie
```sql
SELECT product.*, brand.name as "brand_name", category.name as "category_name"
FROM product
INNER JOIN brand ON brand_id = brand.id
INNER JOIN category ON category_id = category.id
WHERE product.id = 1
;
```

:warning: On ajoute les alias `brand_name` et `category_name` car sinon nous aurions plusieurs champs `name`.