package main

import (
    "encoding/json"
    "fmt"
    "log"
    "net/http"
    "strconv"
    "database/sql"
    "github.com/julienschmidt/httprouter"
    "github.com/gomodule/redigo/redis"
    _ "github.com/go-sql-driver/mysql"
)

type CartRedis struct {
    ID int `json:"id"`
    Quantity int `json:"quantity"`
    Sum int `json:"sum"`
    SumDiscount int `json:"sum_discount"`
    UserIp int `json:"user_ip"`
}

func CartQuantity(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    redis_con, redis_err := redis.Dial(RedisProtocol, RedisHost)
    if redis_err != nil {
        log.Fatal(redis_err)
    }
    defer redis_con.Close()

    cart_quantity,cart_quantity_err := redis.String(redis_con.Do("HGET","__CART__"+ ps.ByName("user") +"__"  + ps.ByName("product") + "__", "quantity"))
    if cart_quantity_err != nil {
        panic(cart_quantity_err)
    }

    fmt.Fprintf(w, cart_quantity)
}

func Cartung(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    fmt.Fprintf(w, getCartArray(ps.ByName("user"),ps.ByName("language"),w))
}

func ClearCart(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")
    redis_con, redis_err := redis.Dial(RedisProtocol, RedisHost)
    if redis_err != nil {
        log.Fatal(redis_err)
    }
    defer redis_con.Close()

    products_arr, products_arr_err := redis.Strings(redis_con.Do("KEYS","*__CART__"+ps.ByName("user")+"__*"))
    if products_arr_err != nil {
        panic(products_arr_err)
    }

    if products_arr != nil {
        for _, key := range products_arr {
            _, cart_arr_err := redis_con.Do("DEL",key)
            if cart_arr_err != nil {
                panic(cart_arr_err)
            }
        }
    }

    fmt.Fprintf(w, getCartArray(ps.ByName("user"),ps.ByName("language"),w))
}

func DeleteCart(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    redis_con, redis_err := redis.Dial(RedisProtocol, RedisHost)
    if redis_err != nil {
        log.Fatal(redis_err)
    }
    defer redis_con.Close()

    _, cart_arr_err := redis_con.Do("DEL","__CART__"+ps.ByName("user")+"__"+ps.ByName("product")+"__")

    if cart_arr_err != nil {
        panic(cart_arr_err)
    }

    fmt.Fprintf(w, getCartArray(ps.ByName("user"),ps.ByName("language"),w))
}

func CartService(w http.ResponseWriter, r *http.Request, ps httprouter.Params){
    w.Header().Set("Access-Control-Allow-Origin", "*")
    redis_con,redis_err := redis.Dial(RedisProtocol, RedisHost)

    quantity:= 0

    if redis_err != nil {
        panic(redis_err.Error())
    }

    cart_quantity,cart_quantity_err := redis.String(redis_con.Do("HGET","__CART__"+ ps.ByName("user") +"__"  + ps.ByName("product") + "__", "quantity"))
    if cart_quantity_err != nil {
        quantity = 0
    }

    quantity,quantity_err := strconv.Atoi(cart_quantity)


    if quantity_err != nil {
        quantity = 0
    }

    switch ps.ByName("type") {
        case "increase":
            if quantity > 0 {
                CartIncrease(quantity,ps.ByName("product"), ps.ByName("user"))
            }else{
                CartIncrease(0,ps.ByName("product"), ps.ByName("user"))
            }
        case "decrease":
            if quantity > 0 {
                CartDecrease(quantity,ps.ByName("product"), ps.ByName("user"))
            }
        case "sum":
            sum,_ := strconv.Atoi(ps.ByName("sum"))
            if sum > 0 {
                CartSum(quantity,ps.ByName("product"), ps.ByName("user"), ps.ByName("sum"))
            }
    }

    fmt.Fprintf(w, getCartArray(ps.ByName("user"),ps.ByName("language"),w))
}


func CartIncrease(quantity int, product_id string, user string) {
    redis_con,redis_err := redis.Dial(RedisProtocol, RedisHost)

    if redis_err != nil {
        panic(redis_err.Error())
    }

    _, cart_quantity_err := redis_con.Do("HSET","__CART__"+ user +"__"  + product_id + "__", "quantity",strconv.Itoa(quantity+1))
    if cart_quantity_err != nil {
        panic(cart_quantity_err.Error())
    }

    _, cart_product_id_err := redis_con.Do("HSET","__CART__"+ user +"__"  + product_id + "__", "product_id",product_id)
    if cart_product_id_err != nil {
        panic(cart_product_id_err.Error())
    }
}

func CartDecrease(quantity int, product_id string, user string) {
    redis_con,redis_err := redis.Dial(RedisProtocol, RedisHost)

    if redis_err != nil {
        panic(redis_err.Error())
    }

    _, cart_quantity_err := redis_con.Do("HSET","__CART__"+ user +"__"  + product_id + "__", "quantity",strconv.Itoa(quantity-1))
    if cart_quantity_err != nil {
        panic(cart_quantity_err.Error())
    }

    _, cart_product_id_err := redis_con.Do("HSET","__CART__"+ user +"__"  + product_id + "__", "product_id",product_id)
    if cart_product_id_err != nil {
        panic(cart_product_id_err.Error())
    }
}

func CartSum(quantity int, product_id string, user string, sum string) {
    redis_con,redis_err := redis.Dial(RedisProtocol, RedisHost)

    if redis_err != nil {
        panic(redis_err.Error())
    }

    _, cart_quantity_err := redis_con.Do("HSET","__CART__"+ user +"__"  + product_id + "__", "quantity",sum)
    if cart_quantity_err != nil {
        panic(cart_quantity_err.Error())
    }

    _, cart_product_id_err := redis_con.Do("HSET","__CART__"+ user +"__"  + product_id + "__", "product_id",product_id)
    if cart_product_id_err != nil {
        panic(cart_product_id_err.Error())
    }
}

func getCartArray(user_ip string,language string,w http.ResponseWriter,)(returned_json string) {
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

    products_arr, products_arr_err := redis.Strings(redis_con.Do("KEYS","*__CART__"+user_ip+"__*"))
    if products_arr_err != nil {
        panic(products_arr_err)
    }

    var products [2]map[int]map[string]string

    products[0] = make(map[int]map[string]string)
    products[1] = make(map[int]map[string]string)

    if products_arr != nil {
        counter := 0
        cart_sum := 0
        cart_all_quantity := 0
        for _, key := range products_arr {
            var tag ProductsTable
            var redis_cart CartRedis

            cart_product_id,cart_product_err_id := redis.String(redis_con.Do("HGET",key,"product_id"))
            if cart_product_err_id != nil {
                panic(cart_product_err_id.Error())
            }

            cart_quantity,cart_quantity_err := redis.String(redis_con.Do("HGET",key,"quantity"))
            if cart_quantity_err != nil {
                panic(cart_quantity_err.Error())
            }

            redis_cart.ID, _ = strconv.Atoi(cart_product_id)
            redis_cart.Quantity, _ = strconv.Atoi(cart_quantity)

            product_row := db.QueryRow("SELECT products.id,products.quantity,products.slug,products.category,products.price,products.discount,products.discount_type,products.is_new,products.status,products.articul, " +
            "products_translation.title AS title, products_translation.description AS description, products_translation.short_description AS short_description, " +
            "filemanager_mediafile.url AS image " +
            "FROM ((products "+
            "INNER JOIN products_translation ON products_translation.product_id=products.id) "+
            "INNER JOIN filemanager_mediafile ON filemanager_mediafile.id=products.image) "+
            "WHERE products.status=1 AND products.id="+strconv.Itoa(redis_cart.ID)+" AND products_translation.language='"+language+"'")



            err = product_row.Scan(&tag.ID, &tag.Quantity, &tag.Slug, &tag.Category, &tag.Price, &tag.Discount, &tag.DiscountType, &tag.IsNew, &tag.Status, &tag.Articul, &tag.Title, &tag.Description, &tag.ShortDescription, &tag.Image)
            if err != nil {
                panic(err.Error())
            }
            
            favourite,favourite_err := redis.String(redis_con.Do("HGET","common\\modules\\shop\\common\\models\\Favourite__"+user_ip+"__"+strconv.Itoa(tag.ID)+"__","product_id"))
            if favourite_err != nil {
                tag.Favourite = false
            }

            if favourite == "2" {
                tag.Favourite = true;
            }else {
                tag.Favourite = false;
            }

            tag.Link = "/" + getCatLink(tag.Category,w) + "/" + tag.Slug

            cart_sum += tag.Price * redis_cart.Quantity
            cart_all_quantity += redis_cart.Quantity

            products[0][counter] = map[string]string{
                "id":strconv.Itoa(tag.ID),
                "product_id": strconv.Itoa(tag.ID),
                "quantity":strconv.Itoa(redis_cart.Quantity),
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
                "sum": strconv.Itoa(tag.Price * redis_cart.Quantity),
                "favourite":strconv.FormatBool(tag.Favourite),
            }
            counter++
        }

        products[1][1] = map[string]string{
            "sum": strconv.Itoa(cart_sum),
            "product_quantity": strconv.Itoa(cart_all_quantity),
        }

        pagesJson, err := json.Marshal(products)
        if err != nil {
            log.Fatal("Cannot encode to JSON ", err)
        }
        returned_json  = string(pagesJson)
        return returned_json
    }else{
        returned_json = "null"
        return returned_json
    }
}