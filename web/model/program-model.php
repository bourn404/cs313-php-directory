<?php

function get_programs($search_query="") {
    $connection= connectDB();

    // $sql = "SELECT * from scriptures WHERE id = :id";
    $sql = 'SELECT programs.*, program_types.label, organizations.org_name FROM programs LEFT JOIN program_types ON programs.program_type_id = program_types.id LEFT JOIN organizations on programs.organization_id = organizations.id';
    if($search_query) {
        $sql = 'SELECT programs.*, program_types.label, organizations.org_name FROM programs LEFT JOIN program_types ON programs.program_type_id = program_types.id LEFT JOIN organizations on programs.organization_id = organizations.id WHERE LOWER(program_name) LIKE :search OR LOWER(label) LIKE :search2 OR LOWER(org_name) LIKE :search3';
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

function get_foundation_programs($org_id) {
    $connection= connectDB();

    // $sql = "SELECT * from scriptures WHERE id = :id";
    $sql = 'SELECT programs.*, program_types.label FROM programs LEFT JOIN program_types ON programs.program_type_id = program_types.id WHERE programs.organization_id = :org';
    
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':org', $org_id, PDO::PARAM_INT);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $results;
}