<?php

require_once "Renderable.php";

class Product implements Renderable
{
    private string $productName;
    private float $productPrice;
    private string $productImageURL;
    private int $productID;

    function __construct(string $productName, float $productPrice, string $productImageURL)
    {
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productImageURL = $productImageURL;
    }

    public function renderHtml()
    {
        $output = "<div>\n";
        $output .= "<b>" . $this->productName ."</b><br>\n";
        $output .= "<img src='productImages/" . $this->productImageURL . "' alt='Picture of " . $this->productName . "'><br>\n";
        $output .= "Price: $" . number_format((float)$this->productPrice, 2, '.', '') . "\n";
        $output .= "</div>";

        return $output;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function setProductName(string $productName)
    {
        $this->productName = $productName;
    }

    public function getProductPrice()
    {
        return $this->productPrice;
    }

    public function setProductPrice(float $productPrice)
    {
        $this->productPrice = $productPrice;
    }

    public function getProductID()
    {
        return $this->productID;
    }

    public function setProductID(int $productID)
    {
        $this->productID = $productID;
    }

    public function getProductImageURL()
    {
        return $this->productImageURL;
    }

    public function setProductImageURL(string $productImageURL)
    {
        $this->productImageURL = $productImageURL;
    }
}

?>