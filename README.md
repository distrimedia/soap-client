# DistriMedia PHP Client

## Introduction 
This module provides PHP Services for the following SOAP calls:

### CreateOrder
1. Create an Order Service Object `Baldwin\DistriMediaClient\Service\Order` 
2. Call the function `createOrder` with the following parameters
    1. Order (`Baldwin\DistriMediaClient\Struct\Order`)
    
### Request Order Status
1. Create an Order Service Object `Baldwin\DistriMediaClient\Service\Order` 
2. Call the function `changeOrderStatusby{$param}` with the following parameters
    1. OrderID (string) | OrderNumber (string) | OrderReference
    2. Status (`Startorder`, `Cancel`)
  
    
### Change Order Status
1. Create an Order Service Object `Baldwin\DistriMediaClient\Service\Order` 
2. Call the function `changeOrderStatus{$param}` with the following parameters
    1. OrderID (string) | OrderNumber (string) | OrderReference
    2. Status (`Startorder`, `Cancel`)
    
### RequestInventory
1. Create an Inventory Service Object `Baldwin\DistriMediaClient\Service\Inventory` 
2. Call the function `changeOrderStatus{$param}` with the following parameters
    1. OrderID (string) | OrderNumber (string) | OrderReference
    2. Status (`Startorder`, `Cancel`)
    
## Authors
 - Tristan Hofman <tristan@baldwin.be>
 
## Testing
1. copy `.env.dist` to `.env` and fill in your credentials. 

2. Execute `docker-compose run phpunit` to run the unit tests
