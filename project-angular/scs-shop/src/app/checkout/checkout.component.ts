import { Component } from '@angular/core';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent {
  cart = []
  provinces = ["AB", "BC", "MB", "NB","NL","NS","NT","NU","ON","PE","QC","SK","YT"];
  defaultProvince = "ON";
  currentStore = "";

  ngOnInit() {
    this.cart = JSON.parse(sessionStorage.getItem("fullCart"));
  }

  cartSubtotal() {
    let prices = this.cart.map((item) => {
      return item.ItemPrice;
    })
    const subtotal = prices.reduce((a, b) => a + b, 0);
    return subtotal;
  }

  
}
