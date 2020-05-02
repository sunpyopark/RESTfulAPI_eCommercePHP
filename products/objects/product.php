<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "product";
 
    // object properties
    public $id;
    public $detail;
    public $image;
    public $price;
    public $shipping_cost;

    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                id, detail , image , price ,shipping_cost
            FROM
                product
                
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
                product
            SET
                detail =:detail, image=:image, price=:price , shipping_cost=:shipping_cost";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->detail=htmlspecialchars(strip_tags($this->detail));
    $this->image=htmlspecialchars(strip_tags($this->image));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->shipping_cost=htmlspecialchars(strip_tags($this->shipping_cost));
    
    // bind values
    $stmt->bindParam(":detail", $this->detail);
    $stmt->bindParam(":image", $this->image);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":shipping_cost", $this->shipping_cost);
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
    id, detail , Image , price,shipping_cost
            FROM
                 product
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
    $this->detail = $row['detail'];
    $this->image = $row['image'];
    $this->price = $row['price'];
    $this->shipping_cost = $row['shipping_cost'];
    
}
    // update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                detail = :detail,
                image = :image,
                price = :price,
                shipping_cost=:shipping_cost
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->detail=htmlspecialchars(strip_tags($this->detail));
    $this->image=htmlspecialchars(strip_tags($this->image));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->shipping_cost=htmlspecialchars(strip_tags($this->shipping_cost));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':detail', $this->detail);
    $stmt->bindParam(':image', $this->image);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':shipping_cost', $this->shipping_cost);
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
    $query = "DELETE FROM product WHERE id = ?";
 
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
/*     // search products
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