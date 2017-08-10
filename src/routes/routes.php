<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require_once "../src/db-config/models.php";


$dhb = null;

$app = new \Slim\App;
/**
 * POST request to create a new user.
 * Of course, your block head should know that the user in this case is a farmer.
 */
$app->post('/api/v1/user/new', function(Request $request, Response $response){
	$parsedBody = $request->getParsedBody();
	$name = $parsedBody['name'];
	$state = $parsedBody['state'];
	$about = $parsedBody['about'];
    $contentType = $request->getContentType();
    if($contentType != "application/json"){
        $data = [
            'code' => '403',
            'message' => 'Content type must be application/json'];
        return $response->withJson($data, 201);
    }
	else if(empty($name) || empty($state) || empty($about)){
		$data = [
		    'code' => '400',
		    'message' => 'One or more parameter is missing'];
		return $response->withJson($data, 201);
						//->write("Hello");
	}else{
        $dhb = new Models(); //Initiate an object of your Models class.
	    $id = $dhb->addUser($name, $state, $about); //call the addUser method
		$data = [
		    'code' => '200',
		    'message' => 'New user created',
            'data' => ['userid' => $id]];
		return $response->withJson($data, 200);
	}
});
/**
 * GET method to fetch the details of a user using the id
 */
$app->get('/api/v1/user/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $dhb = new Models(); //Initiate an object of your Models class.
    $user = $dhb->getUser($id); //call the getUser method
    if($user) {
        $data = [
            'code' => '200',
            'message' => 'Success',
            'data' => [ //Return the user properties of the returned user object.
                'name' => $user->name,
                'state' => $user->state,
                'about' => $user->about
            ]
        ];
        return $response->withJson($data, 200);
    }else{
        $data = [
            'code' => '404',
            'message' => 'Failure',
            'error' => 'No user found'
        ];
        return $response->withJson($data, 404);
    }
});
/**
 * POST method to add farm produce (crops, animals, etc)
 */
$app->post('/api/v1/farm/produce/new', function(Request $request, Response $response){
    $parsedBody = $request->getParsedBody();
    $name = $parsedBody['name'];
    $description = $parsedBody['description'];

    $contentType = $request->getContentType();
    if($contentType != "application/json"){
        $data = [
            'code' => '403',
            'message' => 'Content type must be application/json'];
        return $response->withJson($data, 201);
    }
    else if(empty($name) || empty($description)){
        $data = [
            'code' => '400',
            'message' => 'One or more parameter is missing'];
        return $response->withJson($data, 201);
        //->write("Hello");
    }else{
        $dhb = new Models(); //Initiate an object of your Models class.
        $id = $dhb->addProduce($name, $description); //call the addProduce method
        if($id == 'produce already exist'){ //Check if produce already exist
            $data = [
                'code' => '208',
                'message' => 'failure',
                'error' => $name. ' already exist'];
            return $response->withJson($data, 200);
        }else {
            $data = [
                'code' => '200',
                'message' => 'New produce added',
                'data' => ['produce id' => $id]];
            return $response->withJson($data, 200);
        }
    }
});
/**
 * POST method to add farm price
 */
$app->post('/api/v1/farm/produce/add/price', function(Request $request, Response $response){
    $parsedBody = $request->getParsedBody();
    $userId = $parsedBody['userId'];
    $produceId = $parsedBody['produceId'];
    $price = $parsedBody['pricePerKg'];
    

    $contentType = $request->getContentType();
    if($contentType != "application/json"){
        $data = [
            'code' => '403',
            'message' => 'Content type must be application/json'];
        return $response->withJson($data, 201);
    }
    else if(empty($userId) || empty($produceId) || empty($price)){
        $data = [
            'code' => '400',
            'message' => 'One or more parameter is missing'];
        return $response->withJson($data, 201);
        //->write("Hello");
    }else{
        $dhb = new Models(); //Initiate an object of your Models class.
        $id = $dhb->addPrice($userId, $produceId, $price); //call the addPrice method
        if($id == 'produce already exist'){ //Check if produce already exist
            $data = [
                'code' => '208',
                'message' => 'failure',
                'error' => 'Produce already exist. Update Price Instead'];
            return $response->withJson($data, 208);
        }else if($id == 'produce does not exist'){
            $data = [
                'code' => '404',
                'message' => 'failure',
                'error' => 'Produce does not exist. Add produce first'];
            return $response->withJson($data, 200);
        }else if($id == 'user does not exist'){
            $data = [
                'code' => '404',
                'message' => 'failure',
                'error' => 'User does not exist. Create user first'];
            return $response->withJson($data, 200);
        }
        else {
            $data = [
                'code' => '200',
                'message' => 'Price added for specified product ID'
                ];
            return $response->withJson($data, 200);
        }
    }
});
/**
 * Update the price for a particular user and produce
 */
$app->put('/api/v1/farm/produce/add/price', function(Request $request, Response $response){
    $parsedBody = $request->getParsedBody();
    $userId = $parsedBody['userId'];
    $produceId = $parsedBody['produceId'];
    $price = $parsedBody['pricePerKg'];
  

    $contentType = $request->getContentType();
    if($contentType != "application/json"){
        $data = [
            'code' => '403',
            'message' => 'Content type must be application/json'];
        return $response->withJson($data, 201);
    }
    else if(empty($userId) || empty($produceId) || empty($price)){
        $data = [
            'code' => '400',
            'message' => 'One or more parameter is missing'];
        return $response->withJson($data, 201);
        //->write("Hello");
    }else{
        $dhb = new Models(); //Initiate an object of your Models class.
        $id = $dhb->updatePrice($userId, $produceId, $price); //call the addPrice method
        if($id == 'produce does not exist'){
            $data = [
                'code' => '404',
                'message' => 'failure',
                'error' => 'Produce does not exist. Add produce first'];
            return $response->withJson($data, 200);
        }else if($id == 'user does not exist'){
            $data = [
                'code' => '404',
                'message' => 'failure',
                'error' => 'User does not exist. Create user first'];
            return $response->withJson($data, 200);
        }
        else {
            $data = [
                'code' => '200',
                'message' => 'Price updated for specified product ID',
                'data' => ['newPrice' => number_format($price)]
            ];
            return $response->withJson($data, 200);
        }
    }
});

/**
GET method to fetch prices of a particular produce
**/
$app->get('/api/v1/farm/produce/price/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $dhb = new Models(); //Initiate an object of your Models class.
    $res = $dhb->getPriceByProduceId($id); //call the getUser method
    if($res == "produce does not exist") {
        $data = [
            'code' => '404',
            'message' => 'Failure',
            'data' => [ //Return the user properties of the returned user object.
                'error' => 'produce not found'
            ]
        ];
        return $response->withJson($data, 200);
    }else{
    	foreach ($res as $res) { //Loop through all results
    		$result[] = [ //Store all prices in an array
            	'produce' => $res->produce_name,
            	'pricePerKg' =>  number_format($res->price),
            	'as at' => $res->day,
            	'farmer' => $res->user_name,
            	'state' => $res->state
            ];
        }
        $data = [
            'code' => '200',
            'message' => 'Success',
            'data' => $result     
        ];
        return $response->withJson($data, 200);
    }
});

/**
GET method to fetch all produces

**/
$app->get('/api/v1/farm/produce/list', function(Request $request, Response $response){
    $dhb = new Models(); //Initiate an object of your Models class.
    $res = $dhb->getAllProduce(); //call the getUser method
    if($res == 'no produce') {
        $data = [
            'code' => '404',
            'message' => 'Failure',
            'data' => [ //Return the user properties of the returned user object.
                'error' => 'No produce added yet',
            ]
        ];
        return $response->withJson($data, 200);
    }else{
    	foreach ($res as $res) { //Loop through all results
    		$result[] = [ //Store all prices in an array
            	'id' => $res->id,
            	'name' =>  $res->name,
            	'description' => $res->description
            ];
        }
        $data = [
            'code' => '200',
            'message' => 'Success',
            'data' => $result
        ];
        return $response->withJson($data, 200);
    }
});