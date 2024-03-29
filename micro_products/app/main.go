package main

import (
    "os"
    "net/http"
    "github.com/julienschmidt/httprouter"
    _ "github.com/go-sql-driver/mysql"  
)

var SqlConnectionStr = "root:.products.@tcp("+os.Getenv("K8S_HOST")+":30401)/products"
var SqlDriver = "mysql"
var RedisHost = "monolit-redis-service:6379"
var RedisProtocol = "tcp"

func main() {
    router := httprouter.New()
    router.GET("/get-cats/:language/:parent", GetCats)
    router.GET("/get-products/:language/:category", GetProducts)
    router.GET("/get-product-page/:language/:product", GetProductPage)
    router.GET("/get-filters/:language/:category", GetFilters)
    router.GET("/get-cart/:user/:product/:language/:type/:sum", CartService)
    router.GET("/clear-cart/:user/:language", ClearCart)
    router.GET("/delete-cart/:user/:product/:language", DeleteCart)
    router.GET("/get-cartung/:user/:language", Cartung)
    router.GET("/get-quantity/:user/:product", CartQuantity)

    http.ListenAndServe(":8081", router)

}