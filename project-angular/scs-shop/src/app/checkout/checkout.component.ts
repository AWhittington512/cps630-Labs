import { Component } from '@angular/core';
import { StoreSelectorService } from '../store-selector.service';

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

  constructor (
    private storeService: StoreSelectorService,
  ) {}

  ngOnInit() {
    this.cart = JSON.parse(sessionStorage.getItem("fullCart"))
    //console.log(this.cart);
    this.currentStore = this.getSelectedStore();
  }

  cartSubtotal() {
    let prices = this.cart.map((item) => {
      return item.ItemPrice;
    })
    const subtotal = prices.reduce((a, b) => a + b, 0);
    return subtotal;
  }

  selectStore() {
    this.storeService.selectStore();
    window.location.reload();
  };

  getSelectedStore() {
    return this.storeService.getLocation();
  }
}
