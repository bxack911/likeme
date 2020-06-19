package main

import (
    "net/http"
    "github.com/julienschmidt/httprouter"
    _ "github.com/go-sql-driver/mysql"  
)

var SqlConnectionStr = "root:.sweetpwd.@tcp(172.17.0.3:30004)/my_db"
var SqlDriver = "mysql"
var RedisHost = "monolit-redis-service:6379"
var RedisProtocol = "tcp"

func main() {
    router := httprouter.New()
    router.GET("/get-units/:language/:type", GetUnits)

    http.ListenAndServe(":8081", router)

}