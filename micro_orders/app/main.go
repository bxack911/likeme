package main

import (
    "net/http"
    "github.com/julienschmidt/httprouter"
    _ "github.com/go-sql-driver/mysql"  
)

var SqlConnectionStr = "root:.products.@tcp(products-mysql8-service)/products"
var SqlDriver = "mysql"
var RedisHost = "monolit-redis-service:6379"
var RedisProtocol = "tcp"

func main() {
    router := httprouter.New()
    router.GET("/get-cats/:language/:parent", GetCats)
    router.GET("/get-products/:language/:category", GetProducts)
    router.GET("/get-filters/:language/:category", GetFilters)

    http.ListenAndServe(":8081", router)

}