import { Component } from '@angular/core';
import { StoreSelectorService } from '../store-selector.service';

@Component({
  selector: 'app-storeselector-checkout',
  templateUrl: './storeselector-checkout.component.html',
  styleUrls: ['./storeselector-checkout.component.css']
})
export class StoreselectorCheckoutComponent {
  currentStore = ""

  constructor (
    private storeService: StoreSelectorService,
  ) {}

  ngOnInit() {
    this.currentStore = this.getSelectedStore();
  }

  selectStore() {
    this.storeService.selectStore();
    window.location.reload();
  };

  getSelectedStore() {
    return this.storeService.getLocation();
  }
}
