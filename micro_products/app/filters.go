package main

import (
    "encoding/json"
    "fmt"
    "log"
    "net/http"
    "strconv"
    "database/sql"
    "github.com/julienschmidt/httprouter"
    _ "github.com/go-sql-driver/mysql"  
)

type PropertiesTable struct {
    ID   int    `json:"id"`
    ProductId int `json:"product_id"`
    Status int `json:"status"`
    Parent int `json:"parent"`
    Name string `json:"name"`
    Value string `json:"value"`
}

type ChildProperties struct {
    ID   int    `json:"id"`
    ProductId int `json:"product_id"`
    Status int `json:"status"`
    Parent int `json:"parent"`
    Name string `json:"name"`
    Value string `json:"value"`
}

func GetFilters(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    db, err := sql.Open(SqlDriver, SqlConnectionStr)

    if err != nil {
        log.Print(err.Error())
    }
    defer db.Close()

    // Execute the query
    results_products, err := db.Query("SELECT products.id " +
        "FROM products " + 
        "WHERE products.status=1 AND products.category="+ps.ByName("category"))
    if err != nil {
        panic(err.Error())
    }

    filters := make(map[string]map[int]map[string]map[string]string)

    for results_products.Next() {

        var product_id int

        product_id_err := results_products.Scan(&product_id)
        if product_id_err != nil {
            panic(product_id_err.Error())
        }

        results_properties, props_err := db.Query("SELECT properties.id,properties.product_id,properties.status,COALESCE(properties.parent,0) AS parent, " +
            "properties_translation.name,properties_translation.value " +
            "FROM properties " +
            "INNER JOIN properties_translation ON properties_translation.property_id=properties.id " + 
            "WHERE properties.product_id="+strconv.Itoa(product_id)+" AND properties.parent IS NULL AND properties_translation.language='"+ps.ByName("language")+"'")

        if props_err != nil {
            panic(props_err.Error())
        }

        for results_properties.Next() {

            var tag PropertiesTable

            childs_filters := make(map[int]map[string]string)


            properties_err := results_properties.Scan(&tag.ID,&tag.ProductId,&tag.Status,&tag.Parent,&tag.Name,&tag.Value)
            if properties_err != nil {
                panic(properties_err.Error())
            }


            child_properties, childs_props_err := db.Query("SELECT properties.id,properties.product_id,properties.status,COALESCE(properties.parent,0) AS parent, " +
            "properties_translation.name,properties_translation.value " +
            "FROM properties " +
            "INNER JOIN properties_translation ON properties_translation.property_id=properties.id " + 
            "WHERE properties.product_id="+strconv.Itoa(product_id)+" AND properties.parent="+strconv.Itoa(tag.ID)+" AND properties_translation.language='"+ps.ByName("language")+"'")


            if childs_props_err != nil {
                panic(childs_props_err.Error())
            }

            counter_filter := 0
            for child_properties.Next() {

                var childs ChildProperties

                child_props_err := child_properties.Scan(&childs.ID,&childs.ProductId,&childs.Status,&childs.Parent,&childs.Name,&childs.Value)
                if child_props_err != nil {
                    panic(child_props_err.Error())
                }

                childs_filters[counter_filter] = map[string]string{
                    "id":strconv.Itoa(childs.ID),
                    "product_id":strconv.Itoa(childs.ProductId),
                    "status":strconv.Itoa(childs.Status),
                    "parent":strconv.Itoa(childs.Parent),
                    "name":childs.Name,
                    "value":childs.Value,
                }

                counter_filter++
            }

            childs_propsJson, childs_props_err := json.Marshal(childs_filters)
            if childs_props_err != nil {
                log.Fatal("Cannot encode to JSON ", childs_props_err)
            }


            filters["props"] = map[int]map[string]map[string]string{
                tag.ID:map[string]map[string]string{
                    "prop":map[string]string{
                        "id":strconv.Itoa(tag.ID),
                        "product_id":strconv.Itoa(tag.ProductId),
                        "status":strconv.Itoa(tag.Status),
                        "parent":strconv.Itoa(tag.Parent),
                        "name":tag.Name,
                        "value":tag.Value,
                    },
                    "childs":map[string]string{
                        "array":string(childs_propsJson),
                    },
                },
            }
        }
    }


    var min_price int
    var max_price int

    results_max_price := db.QueryRow("SELECT products.price FROM products WHERE category="+ps.ByName("category")+" AND status=1 ORDER BY PRICE DESC LIMIT 1")
    results_max_price.Scan(&min_price)

    results_min_price := db.QueryRow("SELECT products.price FROM products WHERE category="+ps.ByName("category")+" AND status=1 ORDER BY PRICE ASC LIMIT 1")
    results_min_price.Scan(&max_price)

    filters["prices"] = map[int]map[string]map[string]string{
                    0:map[string]map[string]string{
                        "price":map[string]string{
                            "min":strconv.Itoa(min_price),
                            "max":strconv.Itoa(max_price),
                        },
                    },
                }

    pagesJson, err := json.Marshal(filters)
    if err != nil {
        log.Fatal("Cannot encode to JSON ", err)
    }

    fmt.Fprintf(w, string(pagesJson))
}