package main

import (
    "encoding/json"
    "fmt"
    //"html"
    "log"
    "net/http"
    "strconv"
    "database/sql"
    "github.com/julienschmidt/httprouter"
    _ "github.com/go-sql-driver/mysql"  
)

type UnitsTable struct {
    ID   int    `json:"id"`
    Image string `json:"image"`
    Status int `json:"status"`
    Link string `json:"link"`
    Type int `json:"type"`
    Title string `json:"title"`
    Content string `json:"content"`
    Content2 string `json:"content2"`
    Html2 string `json:"html2"`
    Html string `json:"html"`
}

func GetUnits(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    db, err := sql.Open(SqlDriver, SqlConnectionStr)

    if err != nil {
        log.Print(err.Error())
    }
    defer db.Close()

    // Execute the query
    results, err := db.Query("SELECT units.id,units.status,units.link,units.type, " +
        "units_translation.content AS content, units_translation.content2 AS content2, units_translation.html AS html, units_translation.html2 AS html2, units_translation.title AS title, " +
        "filemanager_mediafile.url AS image " +
        "FROM ((units "+
        "INNER JOIN units_translation ON units_translation.unit_id=units.id) "+
        "INNER JOIN filemanager_mediafile ON filemanager_mediafile.id=units.image) "+
        "WHERE units.status=1 AND units.type="+ps.ByName("type")+" AND units_translation.language='"+ps.ByName("language")+"'")
    if err != nil {
        fmt.Fprintf(w, "test")
    }

    units := make(map[int]map[string]string)

    counter := 0
    for results.Next() {
        var tag UnitsTable

        err = results.Scan(&tag.ID, &tag.Status, &tag.Link, &tag.Type, &tag.Content, &tag.Content2, &tag.Html, &tag.Html2, &tag.Title, &tag.Image)
        if err != nil {
            panic(err.Error())
        }

        units[counter] = map[string]string{
            "id":strconv.Itoa(tag.ID),
            "image":tag.Image,
            "status":strconv.Itoa(tag.Status),
            "link":tag.Link,
            "type":strconv.Itoa(tag.Type),
            "title":tag.Title,
            "content":tag.Content,
            "content2":tag.Content2,
            "html2":tag.Html2,
            "html":tag.Html,
        }
        counter++
    }
    //html.EscapeString(r.URL.Path) : REQUEST_URI
    pagesJson, err := json.Marshal(units)
    if err != nil {
        log.Fatal("Cannot encode to JSON ", err)
    }
    fmt.Fprintf(w, string(pagesJson))
}