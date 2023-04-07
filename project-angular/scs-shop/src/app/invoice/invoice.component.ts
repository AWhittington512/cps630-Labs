import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { CartService } from '../cart.service';

@Component({
  selector: 'app-invoice',
  templateUrl: './invoice.component.html',
  styleUrls: ['./invoice.component.css']
})
export class InvoiceComponent {
  order: any;
  rows: any;
  activeCoupon = {CouponID: 0, CouponCode: "", CouponDiscount: 1};

  constructor (
    private route: ActivatedRoute,
    private httpClient: HttpClient,
    private cart: CartService
  ) {}

  ngOnInit() {
    this.route.queryParams.subscribe((result) => {
      this.order = result["order"];
      //console.log(this.order)

      this.httpClient.get('api/invoice/' + this.order)
        .subscribe(response => {
          this.rows = response;
          console.log(response)
          if (response[0]["CouponID"]) {
            this.cart.getAllCoupons().subscribe((result: Array<any>) => {
              this.activeCoupon = result.filter(item => {return item["CouponID"] == this.rows[0]["CouponID"]})[0];
            })
          }
        })
    })
  }
}
