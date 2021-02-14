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

function save_contact($contact) {
    $connection= connectDB();



    if((int)$contact['id']) {
        // save changes
        $sql = 'UPDATE contacts SET first_name = :first_name,last_name = :last_name,organization_id = :organization_id,is_primary_contact = :is_primary_contact,title = :title,email=:email,phone=:phone,notes=:notes WHERE id = :id';

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':id', (int)$contact['id'], PDO::PARAM_INT);
        $stmt->bindValue(':first_name', $contact['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $contact['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':organization_id', $contact['organization_id'], PDO::PARAM_INT);
        $stmt->bindValue('is_primary_contact', $contact['is_primary_contact'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $contact['title'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $contact['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $contact['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':notes', $contact['notes'], PDO::PARAM_STR);

        $result = $stmt->execute();
        $stmt->closeCursor();

        if($result) {
            return $contact['id'];
        } else {
            return false;
        }

    } else {
        // create new
        $sql = 'INSERT INTO contacts (first_name,last_name,organization_id,is_primary_contact,title,email,phone,notes) VALUES (:first_name,:last_name,:organization_id,:is_primary_contact,:title,:email,:phone,:notes)';
    
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':first_name', $contact['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $contact['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':organization_id', $contact['organization_id'], PDO::PARAM_INT);
        $stmt->bindValue('is_primary_contact', $contact['is_primary_contact'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $contact['title'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $contact['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $contact['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':notes', $contact['notes'], PDO::PARAM_STR);


        $result = $stmt->execute();
        $stmt->closeCursor();

        if($result) {
            $contact_id = $connection->lastInsertId("contacts_id_seq");
            return $contact_id;
        } else {
            return false;
        }


    }
}

function delete_contact($contact_id) {
    $connection= connectDB();

    $sql = 'DELETE from contacts WHERE id = :id';
    
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':id', $contact_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();

}