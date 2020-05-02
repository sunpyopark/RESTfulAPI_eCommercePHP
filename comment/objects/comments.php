<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "comment";
 
    // object properties
    public $id;
    public $productid;
    public $rating;
    public $userid;
    public $image;
    public $description;

    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                id, productid, userid,rating,image,description
            FROM
                comment
                
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
                comment
            SET
            productid=:productid,  userid=:userid, rating=:rating, image=:image, description=:description";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->productid=htmlspecialchars(strip_tags($this->productid));
    $this->userid=htmlspecialchars(strip_tags($this->userid));
    $this->rating=htmlspecialchars(strip_tags($this->rating));
    $this->image=htmlspecialchars(strip_tags($this->image));
    $this->description=htmlspecialchars(strip_tags($this->description));
   
    
    // bind values
    $stmt->bindParam(":productid", $this->productid);
    $stmt->bindParam(":userid", $this->userid);
    $stmt->bindParam(":rating", $this->rating);
    $stmt->bindParam(":image", $this->image);
    $stmt->bindParam(":description", $this->description);
    
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
              productid, userid,rating,image,description
            FROM
              comment
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
    $this->productid = $row['productid'];
    $this->userid = $row['userid'];
    $this->rating = $row['rating'];
    $this->image = $row['image'];
    $this->description = $row['description'];

    
}
    // update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                productid = :productid,
                userid = :userid,
                rating = :rating,
                image = :image,
                text = :description
               
            WHERE
            id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->productid=htmlspecialchars(strip_tags($this->productid));
    $this->userid=htmlspecialchars(strip_tags($this->userid));
    $this->rating=htmlspecialchars(strip_tags($this->rating));
    $this->images=htmlspecialchars(strip_tags($this->images));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->commentid=htmlspecialchars(strip_tags($this->commentid));
 
    // bind new values
    $stmt->bindParam(':productid', $this->productid);
    $stmt->bindParam(':userid', $this->userid);
    $stmt->bindParam(':rating', $this->rating);
    $stmt->bindParam(':image', $this->image);
    $stmt->bindParam(':description', $this->description);
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
    $query = "DELETE FROM comment WHERE id = ?";
 
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