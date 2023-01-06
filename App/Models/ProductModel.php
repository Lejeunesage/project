<?php

/**
 * 
 */
class ProductModel extends Connexion {

    /**
     * $conn
     */
    public $conn;
    
    public $url;

    public $brand;
    public $ref_pro;
    public $label;
    public $price;
    public $price_eco;
    public $desc_pro;
    public $status_pro;
    public $shopray_id;

    public function verifySelect($ref_pro) {
        $this->ref_pro = $ref_pro;
        
        /**
         * 
         */
        $conn = $this->connect();
        /**
         * $sql
         */
        $sql = "SELECT * FROM `hitec`.product WHERE reference = ?;";
        /**
         * $stmt
         */
        $stmt = $conn->prepare($sql);
        $stmt->execute([$this->ref_pro]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function insertProducts($ref_pro, $brand, $label, $price, $price_eco, $desc_pro, $status_pro, $shopray_id) {

        $this->brand = $brand;
        $this->ref_pro = $ref_pro;
        $this->label = $label;
        $this->price = $price;
        $this->price_eco = $price_eco;
        $this->desc_pro = $desc_pro;
        $this->status_pro = $status_pro;
        $this->shopray_id = $shopray_id;
        /**
         * 
         */
        $conn = $this->connect();
        /**
         * $sql
         */
        $sql = "INSERT INTO `hitec`.product VALUES(:ref_pro, :brand, :label, :price, :price_eco, :desc_pro, :status_pro, :shopray_id)";
        /**
         * $stmt
         */
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":ref_pro" => $this->ref_pro,
            ":brand" => $this->brand,
            ":label" => $this->label, 
            ":price" => $this->price, 
            ":price_eco" => $this->price_eco, 
            ":desc_pro" => $this->desc_pro, 
            ":status_pro" => $this->status_pro, 
            ":shopray_id" => $this->shopray_id 
        ]);
    }

    public function joinProductsShopray() {

        $conn = $this->connect();

       $sql = " SELECT
        product.reference,
        product.products_status,
        shopray.shopray_name_shop,
        shopray.shopray_name_ray,
        CONCAT_WS(' ', product.products_brand, product.reference) As Produits
        FROM `product`
        INNER JOIN `shopray` ON shopray.shopray_id = product.shopray_id;";  

        $stmt = $conn->query($sql);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function SelectAllProducts($url) {

        $this->url = $url;
        $conn = $this->connect();

       $sql = "SELECT
       shopray.shopray_id,
       shopray.shopray_name_shop,
       shopray.shopray_name_ray,
       product.reference,
       product.products_status,
       product.products_brand,
       product.products_label,
       product.product_price,
       product.products_price_eco,
       product.products_desc,
       portrait.portrait_id,
       portrait.portrait_title,
       portrait.portrait_image,
       portrait.portrait_text	 	
       FROM `product`
       INNER JOIN `shopray` ON shopray.shopray_id = product.shopray_id
       INNER JOIN `portrait` ON portrait.reference = product.reference
       where product.reference = ?;";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$this->url]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function updateProduct($ref_pro, $brand, $label, $price, $price_eco, $desc_pro, $status_pro, $shopray_id) {
        
        $this->brand = $brand;
        $this->ref_pro = $ref_pro;
        $this->label = $label;
        $this->price = $price;
        $this->price_eco = $price_eco;
        $this->desc_pro = $desc_pro;
        $this->status_pro = $status_pro;
        $this->shopray_id = $shopray_id;

        /**
         * 
         */
        $conn = $this->connect();
        /**
         * $sql
         */
        $sql = "UPDATE `hitec`.product SET products_status = :status_pro, products_brand = :brand, products_label = :label, product_price = :price, products_price_eco = :price_eco, products_desc = :desc_pro, shopray_id = :shopray_id WHERE reference = :ref_pro;";
        /**
         * $stmt
         */
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":ref_pro" => $this->ref_pro,
            ":brand" => $this->brand,
            ":label" => $this->label, 
            ":price" => $this->price, 
            ":price_eco" => $this->price_eco, 
            ":desc_pro" => $this->desc_pro, 
            ":status_pro" => $this->status_pro, 
            ":shopray_id" => $this->shopray_id 
        ]);
    }


}