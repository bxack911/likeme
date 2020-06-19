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

type CategoriesTable struct {
    ID   int    `json:"id"`
    Slug string `json:"slug"`
    Title string `json:"title"`
    Description string `json:"description"`
    Image string `json:"image"`
    ProductQuantity string `json:"product_quantity"`
    Link string `json:link`
}

func GetCats(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    db, err := sql.Open(SqlDriver, SqlConnectionStr)

    if err != nil {
        log.Print(err.Error())
    }
    defer db.Close()

    results, err := db.Query("SELECT category.id,category.parent,category.slug,category_translation.title AS title,category_translation.description AS description, filemanager_mediafile.url AS image FROM ((category INNER JOIN category_translation ON category.id=category_translation.category_id) INNER JOIN filemanager_mediafile ON filemanager_mediafile.id=category.image) WHERE category.parent="+ps.ByName("parent")+" AND category_translation.language='"+ps.ByName("language")+"'")

    if err != nil {
        panic(err.Error())
    }

    categories := make(map[int]map[string]string)

    counter := 0
    for results.Next() {
        var tag CategoriesTable
        var parent int

        err = results.Scan(&tag.ID, &parent, &tag.Slug, &tag.Title, &tag.Description, &tag.Image)
        if err != nil {
            panic(err.Error())
        }

        prod_quan_row := db.QueryRow("SELECT COUNT(id) FROM products WHERE category="+strconv.Itoa(tag.ID))

        prod_quan_err := prod_quan_row.Scan(&tag.ProductQuantity)

        if prod_quan_err != nil && prod_quan_err != sql.ErrNoRows {
            panic(prod_quan_err.Error())
        }

        tag.Link = "/" + getCatLink(parent,w) + "/" + tag.Slug

        categories[counter] = map[string]string{
            "id":strconv.Itoa(tag.ID),
            "slug":tag.Slug,
            "title":tag.Title,
            "description":tag.Description,
            "image":tag.Image,
            "product_quantity":tag.ProductQuantity,
            "link":tag.Link,
        }
        counter++
    }
    //html.EscapeString(r.URL.Path) : REQUEST_URI
    pagesJson, err := json.Marshal(categories)
    if err != nil {
        log.Fatal("Cannot encode to JSON ", err)
    }
    fmt.Fprintf(w, string(pagesJson))
}