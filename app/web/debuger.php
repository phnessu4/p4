<?php

function dbx() {
    echo '<pre>';
    if (func_num_args ()) {
        foreach ( func_get_args () as $k => $v ) {
            echo "------- dbx $k -------<br/>";
            print_r ( $v );
            echo "<br/>";
        }
    }
    ;
    echo '</pre>';
}

function dpx() {
    echo '<pre>';
    if (func_num_args ()) {
        foreach ( func_get_args () as $k => $v ) {
            echo "------- dbx $k -------<br/>";
            var_dump ( $v );
            echo "<br/>";
        }
    }
    ;
    echo '</pre>';
}

function dbt() {
    echo '<pre>';
    if (func_num_args ()) {
        foreach ( func_get_args () as $k => $v ) {
            echo "------- dbx $k -------<br/>";
            echo "<textarea cols=20 rows=6>";
            print_r ( $v );
            echo "</textarea>";
            echo "<br/>";
        }
    }
    ;
    echo '</pre>';
}
?>