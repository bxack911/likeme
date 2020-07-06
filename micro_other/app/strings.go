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

type StringsTable struct {
    ID   int    `json:"id"`
    Key string `json:"key"`
}

func GetTranslations(w http.ResponseWriter, r *http.Request, ps httprouter.Params) {
    w.Header().Set("Access-Control-Allow-Origin", "*")

    db, err := sql.Open(SqlDriver, SqlConnectionStr)

    if err != nil {
        log.Print(err.Error())
    }
    defer db.Close()

    // Execute the query
    results, err := db.Query("SELECT strings.id,strings.str_key FROM strings")
    if err != nil {
        panic(err)
    }

    translations := make(map[string]map[string]string)

    counter := 0
    for results.Next() {
        var tag StringsTable

        err = results.Scan(&tag.ID, &tag.Key)
        if err != nil {
            panic(err.Error())
        }

        results_translations, err := db.Query("SELECT strings_translation.language, strings_translation.value FROM strings_translation WHERE strings_translation.string_id=" + strconv.Itoa(tag.ID))
        translations_map := make(map[string]string)

        tr_counter := 0
        for results_translations.Next() {
            var translation_language string
            var translation_value string

            err = results_translations.Scan(&translation_language,&translation_value)
            if err != nil {
                panic(err.Error())
            }

            translations_map[translation_language] = translation_value

            tr_counter++
        }

        tr_stringsJson, err := json.Marshal(translations_map)
            if err != nil {
                log.Fatal("Cannot encode to JSON ", err)
            }

        translations[tag.Key] = map[string]string{
            "id":strconv.Itoa(tag.ID),
            "value":string(tr_stringsJson),
        }
        counter++
    }
    //html.EscapeString(r.URL.Path) : REQUEST_URI
    stringsJson, err := json.Marshal(translations)
    if err != nil {
        log.Fatal("Cannot encode to JSON ", err)
    }
    fmt.Fprintf(w, string(stringsJson))
}