<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
    public $id;
    public $email;
    public $password;
    public $billing_address;
    public $purchase_history;
    public $shipping_address;
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                id, email,password, billing_address,purchase_history,shipping_address
            FROM
                user
                
            ORDER BY
            userid DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
    // create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                user
            SET
            email=:email, password=:password, billing_address=:billing_address, purchase_history=:purchase_history,shipping_address=:shipping_address";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->billing_address=htmlspecialchars(strip_tags($this->billing_address));
    $this->purchase_history=htmlspecialchars(strip_tags($this->purchase_history));
    $this->shipping_address=htmlspecialchars(strip_tags($this->shipping_address));
  
    
    // bind values
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":billing_address", $this->username);
    $stmt->bindParam(":purchase_history", $this->purchase_history);
    $stmt->bindParam(":shipping_address", $this->shipping_address);
    
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
    // used when filling up the update product form
function readOne(){
 
    // query to read single record
    $query = "SELECT
                userid, email,password, billing_address,purchase_history,shipping_address
            FROM
            user
            WHERE
                userid = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->email = $row['email'];
    $this->password = $row['password'];
    $this->username = $row['billing_address'];
    $this->purchase_history = $row['purchase_history'];
    $this->shipping_address = $row['shipping_address'];
    
}
    // update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
            
            email = :email,
            password = :password,
            billing_address = :billing_address,
            purchase_history = :purchase_history,
            shipping_address = :shipping_address
            WHERE
                userid = :userid";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->billing_address=htmlspecialchars(strip_tags($this->billing_address));
    $this->purchase_history=htmlspecialchars(strip_tags($this->purchase_history));
    $this->shipping_address=htmlspecialchars(strip_tags($this->shipping_address));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':billing_address', $this->billing_address);
    $stmt->bindParam(':purchase_history', $this->purchase_history);
    $stmt->bindParam(':shipping_address', $this->shipping_address);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
    // delete the product
function delete(){
 
    // delete query
    $query = "DELETE FROM user WHERE userid = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->userid=htmlspecialchars(strip_tags($this->userid));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->userid);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
   /*  // search products
function search($keywords){
 
    // select all query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
            ORDER BY
                p.created DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
} */
}