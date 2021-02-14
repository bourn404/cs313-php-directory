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

function save_foundation($foundation) {
    $connection= connectDB();

    if($foundation['id']) {
        // save changes
        $sql = 'UPDATE organizations SET org_name = :org_name, address1 = :address1, city = :city, state = :state, zip = :zip, website = :website WHERE id = :id';
    
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':id', $foundation['id'], PDO::PARAM_INT);
        $stmt->bindValue(':org_name', $foundation['org_name'], PDO::PARAM_STR);
        $stmt->bindValue(':address1', $foundation['address1'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $foundation['city'], PDO::PARAM_STR);
        $stmt->bindValue(':state', $foundation['state'], PDO::PARAM_STR);
        $stmt->bindValue(':zip', $foundation['zip'], PDO::PARAM_STR);
        $stmt->bindValue(':website', $foundation['website'], PDO::PARAM_STR);

        $result = $stmt->execute();
        $stmt->closeCursor();

        if($result) {
            return $foundation['id'];
        } else {
            return false;
        }

    } else {
        // create new
        $sql = 'INSERT INTO organizations (org_name,address1,city,state,zip,website) VALUES (:org_name,:address1,:city,:state,:zip,:website)';
    
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':org_name', $foundation['org_name'], PDO::PARAM_STR);
        $stmt->bindValue(':address1', $foundation['address1'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $foundation['city'], PDO::PARAM_STR);
        $stmt->bindValue(':state', $foundation['state'], PDO::PARAM_STR);
        $stmt->bindValue(':zip', $foundation['zip'], PDO::PARAM_STR);
        $stmt->bindValue(':website', $foundation['website'], PDO::PARAM_STR);

        $result = $stmt->execute();
        $stmt->closeCursor();

        if($result) {
            $org_id = $connection->lastInsertId("organizations_id_seq");
            return $org_id;
        } else {
            return false;
        }


    }
}

function delete_foundation($foundation_id) {
    $connection= connectDB();

    $sql = 'DELETE from organizations WHERE id = :id';
    
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', $foundation_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();

}