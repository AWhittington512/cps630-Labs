<?php

require_once "Renderable.php";

class Product implements Renderable
{
    private string $productName;
    private float $productPrice;
    private string $productImageURL;
    private int $productID;

    function __construct(int $productID, string $productName, float $productPrice, string $productImageURL)
    {
        $this->productID = $productID;
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
        $output .= '<form method="post">';
        $output .= "<img name='productImage' src='productImages/" . $this->productImageURL . "' width='300' height='300'  draggable='false'>";
        $output .= "<p class='invisible' name='productID'>" . $this->productID . "</p>";
        $output .= "<h2 name='productName'>" . $this->productName . "</h2>";
        $output .= '
                <div class="m-2">
                    <label for="productSize">Size</label>
                    <select name="productSize" id="productSize" class="form-select form-select-sm">;
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                    </select>
                </div>
                <div class="m-2">
                    <label for="productQuantity">Quantity</label>
                    <select name="productQuantity" id="productQuantity" class="form-select form-select-sm">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            ';
        $output .= "<p name='productPrice'>$" . number_format((float)$this->productPrice, 2, '.', '') . "</p>";
        $output .= "<button type='submit' name='addToCart' class='btn btn-outline-primary'>Add to Cart</button>";
        $output .= "</div></form>";

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

