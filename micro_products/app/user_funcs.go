package main


import (
    "log"
    "net/http"
    "strconv"
    "database/sql"
    "encoding/json"
    _ "github.com/go-sql-driver/mysql"  
)

func getCatLink(cat_id int,w http.ResponseWriter) (link_string string) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    link_string = ""
    db, err := sql.Open(SqlDriver, SqlConnectionStr)

    if err != nil {
        log.Print(err.Error())
    }
    defer db.Close()

    var segment1 string
    var parent1 int

    results := db.QueryRow("SELECT slug,parent FROM category WHERE id="+strconv.Itoa(cat_id))
    results.Scan(&segment1,&parent1)


    var segment2 string
    var parent2 int

    results2 := db.QueryRow("SELECT slug,parent FROM category WHERE id="+strconv.Itoa(parent1))
    results2.Scan(&segment2,&parent2)

    var segment3 string
    var parent3 int

    results3 := db.QueryRow("SELECT slug,parent FROM category WHERE id="+strconv.Itoa(parent2))
    results3.Scan(&segment3,&parent3)

    if len(segment3) > 0 {
        link_string += segment3
    }

    if len(segment2) > 0 {
        if len(segment3) > 0{ link_string += "/" }
        link_string += segment2
    }

    if len(segment1) > 0 {
        if len(segment2) > 0{ link_string += "/" }

        link_string += segment1
    }

    return link_string
}
func getDiscout(returned_type string, discount_type int, price int, discount_sql int) (discount string) {
    if discount_sql != 0 {
        if discount_type == 1 {
            var discount_integer int
            discount_integer = price * discount_sql / 100;
            if returned_type == "label" {
                discount = strconv.Itoa(discount_integer) + " грн.";
            }else {
                discount = strconv.Itoa(price - discount_integer);
            }
        }else if discount_type == 2 {
            if returned_type == "label" {
                discount = strconv.Itoa(discount_sql) + " грн."
            }else {
                discount = strconv.Itoa(price - discount_sql)
            }
        }

        return discount

    }else{
        return "0"
    }
}

func GetProductGallery(product int,w http.ResponseWriter) (gallery string){
    w.Header().Set("Access-Control-Allow-Origin", "*")
    db, err := sql.Open(SqlDriver, SqlConnectionStr)
    if err != nil {
        log.Print(err.Error())
    }
    defer db.Close()

    gallery_map := make(map[int]map[string]string)

    gallery_query, gallery_err := db.Query("SELECT gallery_image.rank FROM gallery_image WHERE type='products' AND ownerId="+strconv.Itoa(product))
    
    if gallery_err != nil {
        panic(gallery_err.Error())
    }

    counter := 0
    for gallery_query.Next() {
        var image string

        scan_err := gallery_query.Scan(&image)
        if scan_err != nil {
            panic(scan_err.Error())
        }

        gallery_map[counter] = map[string]string{
            "image": "/storage/gallery/products/" + strconv.Itoa(product) + "/" + image + "/medium.jpg",
        }

        counter++
    }

    galleryJson, gallery_err := json.Marshal(gallery_map)
    if gallery_err != nil {
        log.Fatal("Cannot encode to JSON ", gallery_err)
    }

    gallery = string(galleryJson)

    return gallery
}

func GetProductsImage2(product int,w http.ResponseWriter) (image2 string) {
    w.Header().Set("Access-Control-Allow-Origin", "*")
    db, err := sql.Open(SqlDriver, SqlConnectionStr)
    if err != nil {
        log.Print(err.Error())
    }
    defer db.Close()

    var rank string

    image2row := db.QueryRow("SELECT gallery_image.rank FROM gallery_image WHERE type='products' AND ownerId="+strconv.Itoa(product)+" LIMIT 1")
    image2_err := image2row.Scan(&rank)

    if image2_err != nil {
        panic(image2_err.Error())
    }

    image2 = "/storage/gallery/products/" + strconv.Itoa(product) + "/" + rank + "/medium.jpg"

    return image2
}