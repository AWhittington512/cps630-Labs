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
        // $output = "<div>\n";
        // $output .= "<b>" . $this->productName ."</b><br>\n";
        // $output .= "<img src='productImages/" . $this->productImageURL . "' alt='Picture of " . $this->productName . "'><br>\n";
        // $output .= "Price: $" . number_format((float)$this->productPrice, 2, '.', '') . "\n";
        // $output .= "</div>";

        $output = "<div class='col border rounded p-3' draggable='true'>";
        $output .= "<img src='productImages/" . $this->productImageURL . "' width='300' height='300'  draggable='false'>";
        $output .= "<h2>" . $this->productName . "</h2>";
        $output .= "<select name='size' id='size' class='form-select form-select-sm'>";
        $output .= "<option value='s'>S</option>";
        $output .= "<option value='m'>M</option>";
        $output .= "<option value='l'>L</option>";
        $output .= "</select>";
        $output .= "<p>$" . number_format((float)$this->productPrice, 2, '.', '') . "</p>";
        $output .= "<button type='button' class='btn btn-outline-primary'>Add to Cart</button>";
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