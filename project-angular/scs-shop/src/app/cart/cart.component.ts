import { Component } from '@angular/core';
import { ItemService } from '../item.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent {
  availableItems : any;
  cartItems;
  fullCart = []

  constructor(private itemService: ItemService) { }

  ngOnInit() {      
    this.itemService.getItems()
      .subscribe(response => {
        this.availableItems = response;
        //console.log(this.availableItems);

        this.cartItems = sessionStorage.getItem("cart");
        //console.log(this.cartItems);
        if (this.cartItems) {
          this.fullCart = this.mapCartItems(JSON.parse(this.cartItems)["cartItemIds"]);
        }
        
        //console.log(this.fullCart)
      });
  }

  // item ids from cart => full item info
  mapCartItems(cart: Array<string>) {
    //let test = this.availableItems.filter(item => item.ItemID == "1");

    let itemList = cart.map((id) => {
      //console.log(id)
      return this.availableItems.filter(item => item.ItemID == id)[0];
    })
    //console.log(itemList);
    return itemList;
  }
  
  clearCart() {
    sessionStorage.removeItem("cart");
    window.location.reload();
  }
}
