<?php

require_once "Renderable.php";

class CartItem implements Renderable
{
    private string $productName;
    private float $productPrice;
    private string $productImageURL;
    private int $quantity;
    private int $productID;

    function __construct(string $productName, float $productPrice, string $productImageURL, int $quantity)
    {
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productImageURL = $productImageURL;
        $this->quantity = $quantity;
    }

    public function renderHtml()
    {
        $output = "<div>\n";
        $output .= "<b>" . $this->productName ."</b><br>\n";
        $output .= "<img style='float: left;' src='productImages/" . $this->productImageURL . "' alt='Picture of " . $this->productName . "'>\n";
        $output .= "<div>\nQuantity: " . $this->quantity . "<br>\n";
        $output .= "Total Price: $" . number_format((float)($this->productPrice * $this->quantity), 2, '.', '') . "\n</div>\n";
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

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
}

?>