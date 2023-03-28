import { Component, OnInit } from '@angular/core';
import { CurrencyPipe } from '@angular/common';
import { ItemService } from '../item.service';

@Component({
  selector: 'app-items',
  templateUrl: './items.component.html',
  styleUrls: ['./items.component.css']
})

export class ItemsComponent implements OnInit {
  items : any;

  constructor(private service: ItemService) { }

  ngOnInit() {      
    this.service.getItems()
      .subscribe(response => {
        this.items = response;
      });
  }

  onDrag(event) {
    //event.dataTransfer.clearData();
    //console.log(event.target.id)
    event.dataTransfer.setData("text", event.target.id);
    //event.dataTransfer.setData("text/plain", "text");
  }

  addToCart(event) {
    const itemId = event.target.parentElement.id;

    var cartItems = {};
    if (! sessionStorage.getItem("cart")) {
      cartItems = {
        "cartItemIds": [itemId]
      }
    } else {
      cartItems = JSON.parse(sessionStorage.getItem("cart"));
      cartItems["cartItemIds"].push(itemId);
    }

    sessionStorage.setItem("cart", JSON.stringify(cartItems));
    console.log(cartItems);
  }
}
