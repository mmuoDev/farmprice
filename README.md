# farmprice
An API developed to easily get current farm prices of different in the Nigerian agricultural market. API was developed using slim v3 

I have added a sample database data in the src/db/ folder. Simply import. 

Clone this repo and call these endpoints using the defined RESTFul methods 

POST '/api/v1/user/new' - Add a  farmer

GET '/api/v1/user/{id}' - Get details of a farmer
    
POST '/api/v1/farm/produce/new' - Add a farm produce
   
POST '/api/v1/farm/produce/add/price' - Add price for a farm produce

PUT '/api/v1/farm/produce/add/price'  Update farm price
    
GET '/api/v1/farm/produce/price/{id}' - fetch prices of a particular produce

GET '/api/v1/farm/produce/list' - fetch all produces
   
