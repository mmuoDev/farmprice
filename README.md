# Farmprice

An API developed to easily get current farm prices of different in the Nigerian agricultural market. API was developed using slim v3 

I have added a sample database data in the `src/db` folder. Simply import. 

Clone this repo and call these endpoints using the defined RESTFul methods 

#### Add a farmer
```
POST /api/v1/user/new  

{
    'name' => 'Farmer Name', 
    'state' => 'Farmer State', 
    'about' => 'Farmer Bio'
}
```

#### Get details of a farmer
```
GET /api/v1/user/{id}
``` 

#### Add a farm produce
```
POST /api/v1/farm/produce/new

{
    'name' => 'Product Name', 
    'description' => 'Product Description'
}
 ```

#### Add price for a farm produce
```
POST '/api/v1/farm/produce/add/price' 
{
    'userId' => 'userId', 
    'produceId' => 'produceId', 
    'pricePerKg' => 'pricePerKg'
}
```

#### Update farm price
```
PUT /api/v1/farm/produce/add/price
{
    'userId' => 'userId', 
    'produceId' => 'produceId', 
    'pricePerKg' => 'pricePerKg'
}
```

#### Fetch prices of a particular produce
```
GET /api/v1/farm/produce/price/{id}
```

#### Fetch all produce
GET /api/v1/farm/produce/list

---

### Keep in touch

Mail: [radioactive[dot]uche11[at]gmail[dot]com](mailto:radioactive.uche11@gmail.com)
   
