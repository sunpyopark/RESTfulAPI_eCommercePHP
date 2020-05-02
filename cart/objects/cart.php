<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "cart";
 
    // object properties
    public $id;
    public $productid;
    public $quantity;
    public $userid;
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                id, product, quantity, userid
            FROM
                cart
                
            ORDER BY
                id DESC";
 
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
                cart
            SET
                product=:product, quantity=:quantity, userid=:userid";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->products=htmlspecialchars(strip_tags($this->products));
    $this->quantities=htmlspecialchars(strip_tags($this->quantities));
    $this->user=htmlspecialchars(strip_tags($this->user));
    
    // bind values
    $stmt->bindParam(":product", $this->product);
    $stmt->bindParam(":quantity", $this->quantity);
    $stmt->bindParam(":userid", $this->userid);
    
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
                product, quantity, userid
            FROM
                cart
            WHERE
                id = ?
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
    $this->products = $row['product'];
    $this->quantities = $row['quantitie'];
    $this->user = $row['userid'];
    
}
    // update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                product = :product,
                quantity = :quantity,
                userid = :userid
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->products=htmlspecialchars(strip_tags($this->products));
    $this->quantities=htmlspecialchars(strip_tags($this->quantities));
    $this->user=htmlspecialchars(strip_tags($this->user));
    $this->cartid=htmlspecialchars(strip_tags($this->cartid));
 
    // bind new values
    $stmt->bindParam(':product', $this->product);
    $stmt->bindParam(':quantity', $this->quantity);
    $stmt->bindParam(':userid', $this->userid);
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
    $query = "DELETE FROM cart WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
  
}
