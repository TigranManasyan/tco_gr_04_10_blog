<?php

class Database {
    public function connect() {
        return new mysqli("localhost", "root", "", "tm_blog");
    }
}