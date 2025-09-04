# GET /products/

## Response
```json
{
  "products": {
    "current_page": "<int>",
    "data": [
      {
        "id": "<string>",
        "name": "<string>",
        "sku": "<string>",
        "status": true,
        "type": "<string>",
        "category_id": "<string>",
        "category": {
          "id": "<string>",
          "name": "<string>"
        },
        "variants": [
          {
            "name": "<string> 1",
            "capital_price": "<int>",
            "sell_price": "<int>",
            "special_price": "<int>",
            "stock": "<int>"
          }
        ],
        "created_at": "<date>",
        "updated_at": "<date>"
      }
    ],
    "last_page": 3,
    "per_page": 5,
    "total": 15
  }
}
```

# POST /products/

## Response
```json
    { 
        "message": "<string>"
    }
```

## Error
```json
{
    "message": "<string>"
}
```

# PUT /products/{id}

## Response
```json
    { 
        "message": "<string>"
    }
```

## Error
```json
{
    "message": "<string>"
}
```

# DELETE /products/{id}

## Response
```json
    { 
        "message": "<string>"
    }
```