<?php
class Controller
{
  private $connection;
  public function connectToDB()
  {
    include "./DBConnect.php";
    $this->connection = $connection;
  }

  public function runQuery($query)
  {
    $result = mysqli_query($this->connection, $query);

    if (!$result) {
      die('Query run failed: ' . mysqli_error($this->connection));
    }

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $data;
  }

  public function getCart($userID)
  {
    $query = "SELECT * FROM shopping_cart WHERE UserID = $userID";
    $cart = $this->runQuery($query);
    return $cart;
  }

  public function addToCart($uid, $iid, $quantity, $size)
  {
    $query = "INSERT INTO shopping_cart (UserID, ItemID, Quantity, Size) VALUES ($uid, $iid, $quantity, $size)";
    $result = $this->runQuery($query);
    if (!$result) {
      die('Cannot add item to cart');
    }
  }

  public function removeFromCart($uid, $iid, $quantity, $size) {
    $query = "DELETE FROM shopping_cart WHERE userID = $uid AND ItemID = $iid AND Quantity = $quantity AND Size = $size";
    $result = $this->runQuery($query);
    if (!$result) {
      die('Cannot remove item from cart');
    }
  }
}
