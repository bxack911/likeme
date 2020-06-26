package main

import (
    "encoding/json"
    "fmt"
    //"html"
    "net"
    "log"
    "net/http"
    "strconv"
    "database/sql"
    "github.com/julienschmidt/httprouter"
    "github.com/gomodule/redigo/redis"
    _ "github.com/go-sql-driver/mysql"  
)

type ProductsTable struct {
    ID   int    `json:"id"`
    Quantity int `json:"quantity"`
    Slug string `json:"slug"`
    Category int `json:"category"`
    Price int `json:"price"`
    Discount int `json:"discount"`
    DiscountType int `json:"discount_type"`
    IsNew int `json:"is_new"`
    Status int `json:"status"`
    Articul string `json:"articul"`
    Title string `json:"title"`
    Description string `json:"description"`
    ShortDescription string `json:"short_description"`
    Image string `json:"image"`
    Link string `json:"link"`
    Favourite bool `json:favourite`
}

func GetProducts(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    db, err := sql.Open(SqlDriver, SqlConnectionStr)

    if err != nil {
        log.Print(err.Error())
    }
    defer db.Close()

    redis_con, redis_err := redis.Dial(RedisProtocol, RedisHost)
    if redis_err != nil {
        log.Fatal(redis_err)
    }
    defer redis_con.Close()


    results, err := db.Query("SELECT products.id,products.quantity,products.slug,products.category,products.price,products.discount,products.discount_type,products.is_new,products.status,products.articul, " +
        "products_translation.title AS title, products_translation.description AS description, products_translation.short_description AS short_description, " +
        "filemanager_mediafile.url AS image " +
        "FROM ((products "+
        "INNER JOIN products_translation ON products_translation.product_id=products.id) "+
        "INNER JOIN filemanager_mediafile ON filemanager_mediafile.id=products.image) "+
        "WHERE products.status=1 AND products.category="+ps.ByName("category")+" AND products_translation.language='"+ps.ByName("language")+"'")
    if err != nil {
        panic(err.Error())
    }

    products := make(map[int]map[string]string)

    counter := 0
    for results.Next() {
        var tag ProductsTable

        err = results.Scan(&tag.ID, &tag.Quantity, &tag.Slug, &tag.Category, &tag.Price, &tag.Discount, &tag.DiscountType, &tag.IsNew, &tag.Status, &tag.Articul, &tag.Title, &tag.Description, &tag.ShortDescription, &tag.Image)
        if err != nil {
            panic(err.Error())
        }

        ip,_,_ := net.SplitHostPort(r.RemoteAddr)
        
        favourite,favourite_err := redis.String(redis_con.Do("HGET","common\\modules\\shop\\common\\models\\Favourite__"+ip+"__"+strconv.Itoa(tag.ID)+"__","product_id"))
        if favourite_err != nil {
            tag.Favourite = false
        }

        if favourite == "2" {
            tag.Favourite = true;
        }else {
            tag.Favourite = false;
        }

        tag.Link = "/" + getCatLink(tag.Category,w) + "/" + tag.Slug

        products[counter] = map[string]string{
            "id":strconv.Itoa(tag.ID),
            "quantity":strconv.Itoa(tag.Quantity),
            "slug":tag.Slug,
            "category":strconv.Itoa(tag.Category),
            "price":strconv.Itoa(tag.Price),
            "discount":getDiscout("label",tag.DiscountType,tag.Price,tag.Discount),
            "discount_sum":getDiscout("sum",tag.DiscountType,tag.Price,tag.Discount),
            "discount_type":strconv.Itoa(tag.DiscountType),
            "is_new":strconv.Itoa(tag.IsNew),
            "status":strconv.Itoa(tag.Status),
            "articul":tag.Articul,
            "title":tag.Title,
            "description":tag.Description,
            "short_description":tag.ShortDescription,
            "image":tag.Image,
            "image2":GetProductsImage2(tag.ID,w),
            "link":tag.Link,
            "favourite":strconv.FormatBool(tag.Favourite),
        }
        counter++
    }
    //html.EscapeString(r.URL.Path) : REQUEST_URI
    pagesJson, err := json.Marshal(products)
    if err != nil {
        log.Fatal("Cannot encode to JSON ", err)
    }
    fmt.Fprintf(w, string(pagesJson))
}