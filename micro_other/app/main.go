package main

import (
    "os"
    "net/http"
    "github.com/julienschmidt/httprouter"
    _ "github.com/go-sql-driver/mysql"  
)

var SqlConnectionStr = "root:.sweetpwd.@tcp("+os.Getenv("K8S_HOST")+":30004)/my_db"
var SqlDriver = "mysql"

func main() {
    router := httprouter.New()
    router.GET("/get-units/:language/:type", GetUnits)
    router.GET("/get-translations", GetTranslations)

    http.ListenAndServe(":8081", router)

}