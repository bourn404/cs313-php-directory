<?php

function get_foundations($search_query="") {
    $connection= connectDB();

    // $sql = "SELECT * from scriptures WHERE id = :id";
    $sql = "SELECT * from organizations";
    if($search_query) {
        $sql = 'SELECT * from organizations WHERE LOWER(org_name) LIKE :search OR LOWER(city) LIKE :search2 OR LOWER(state) LIKE :search3';
    }
    

    $stmt = $connection->prepare($sql);
    if($search_query) {
        $search_query_lower = strtolower($search_query);
        $stmt->bindValue(':search', '%'.$search_query_lower.'%', PDO::PARAM_STR);
        $stmt->bindValue(':search2', '%'.$search_query_lower.'%', PDO::PARAM_STR);
        $stmt->bindValue(':search3', '%'.$search_query_lower.'%', PDO::PARAM_STR);
    }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $results;
}

function get_foundation($id) {
    $connection= connectDB();

    $sql = 'SELECT * from organizations WHERE id = :id';
    
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $results;
}