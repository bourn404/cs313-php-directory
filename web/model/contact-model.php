<?php

function get_contacts($search_query="") {
    $connection= connectDB();

    // $sql = "SELECT * from scriptures WHERE id = :id";
    $sql = 'SELECT contacts.*, organizations.org_name FROM contacts LEFT JOIN organizations ON contacts.organization_id = organizations.id';
    if($search_query) {
        $sql = 'SELECT contacts.*, organizations.org_name FROM contacts LEFT JOIN organizations ON contacts.organization_id = organizations.id WHERE LOWER(first_name) LIKE :search OR LOWER(last_name) LIKE :search2 OR LOWER(org_name) LIKE :search3';
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

function get_contact($id) {
    $connection= connectDB();

    $sql = 'SELECT contacts.*, organizations.org_name FROM contacts LEFT JOIN organizations ON contacts.organization_id = organizations.id WHERE contacts.id = :id';
    
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $results;
}

function get_foundation_contacts($org_id) {
    $connection= connectDB();

    // $sql = "SELECT * from scriptures WHERE id = :id";
    $sql = 'SELECT contacts.* FROM contacts WHERE contacts.organization_id = :org';
    
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':org', $org_id, PDO::PARAM_INT);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $results;
}