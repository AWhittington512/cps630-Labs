import { Component } from '@angular/core';
import { FormBuilder, Validators, ValidatorFn, AbstractControl } from '@angular/forms';
import { Router } from '@angular/router';
import { GeocodingService } from '../geocoding.service';
import { GeocoderResponse } from '../models/geocoder-response.model';
import { StoreSelectorService } from '../store-selector.service';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent {
  static POSTCHECK: RegExp = /^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/;
  static EXPCHECK: RegExp = /^\d{2}\/{0,1}\d{2}$/;
  static CVVCHECK: RegExp = /^\d{3}$/;
  static CCCHECK: RegExp = /^\d{4}\ {0,1}\d{4}\ {0,1}\d{4}\ {0,1}\d{4}$/;

  cart = []
  provinces = ["AB", "BC", "MB", "NB","NL","NS","NT","NU","ON","PE","QC","SK","YT"];
  defaultProvince = "ON";
  currentStore = "";
  //0: shipping, 1: delivery, 2: payment, 3: complete
  checkoutStep = 0;

  constructor (
    private router: Router,
    private storeSelectorService: StoreSelectorService,
    private geocodingService: GeocodingService,
    private formBuilder: FormBuilder,
  ) {}

  shipToForm = this.formBuilder.group({
    fn: ["", Validators.required],
    ln: ["", Validators.required],
    address: ["", Validators.required],
    city: ["", Validators.required],
    province: ["ON", Validators.required],
    postcode: ["", [
      Validators.required,
      Validators.maxLength(7),
      this.regexValidator({pattern: CheckoutComponent.POSTCHECK, msg: "Invalid postal code"})
    ]]
  })

  get fn() {return this.shipToForm.get('fn')};
  get ln() {return this.shipToForm.get('ln')};
  get address() {return this.shipToForm.get('address')};
  get city() {return this.shipToForm.get('city')};
  get province() {return this.shipToForm.get('province')};
  get postcode() {return this.shipToForm.get('postcode')};

  paymentForm = this.formBuilder.group({
    card: ["", [
      Validators.required,
      this.regexValidator({pattern: CheckoutComponent.CCCHECK, msg: "Invalid card number"}),
    ]],
    expiry: ["", [
      Validators.required,
      this.regexValidator({pattern: CheckoutComponent.EXPCHECK, msg: "Invalid expiry"}), //fix this check
    ]],
    cvv: ["", [
      Validators.required,
      this.regexValidator({pattern: CheckoutComponent.CVVCHECK, msg: "Invalid CVV"}),
    ]],
    paymentPC: ["", [
      Validators.required,
      this.regexValidator({pattern: CheckoutComponent.POSTCHECK, msg: "Invalid postal code"})
    ]]
  })

  get card() {return this.paymentForm.get('card')};
  get expiry() {return this.paymentForm.get('expiry')};
  get cvv() {return this.paymentForm.get('cvv')};
  get paymentPC() {return this.paymentForm.get('paymentPC')};

  regexValidator(config: any): ValidatorFn {
    return (control: AbstractControl) => {
      let regex: RegExp = config.pattern;
      if (control.value && !control.value.match(regex)) {
        return {
          invalidMsg: config.msg
        };
      } else {
        return null;
      }
    };
  }

  formatPostcode(postcode: string): string {
    const upper = postcode.toUpperCase();
    if (postcode.length == 6) {
      return upper.slice(0, 3) + " " + upper.slice(3);
    } else {
      return upper;
    }
  }

  formatCardNum(card: string): string {
    return card.replaceAll(' ', '');
  }

  formatExpiry(expiry: string): string {
    return !expiry.includes('/') ? expiry.slice(0,2) + "/" + expiry.slice(2) : expiry;
  }

  ngOnInit() {
    this.cart = JSON.parse(sessionStorage.getItem("fullCart"));
    //this.checkoutStep = "shipping"; 
  }

  cartSubtotal() {
    let prices = this.cart.map((item) => {
      return item.ItemPrice;
    })
    const subtotal = prices.reduce((a, b) => a + b, 0);
    return subtotal;
  }

  back() {
    (this.checkoutStep > 0) ? this.checkoutStep -= 1 : this.router.navigate(['/cart']);
    console.log(this.checkoutStep);
  }

  toDelivery() {
    this.currentStore = this.storeSelectorService.getLocation();
    this.shipToForm.controls['postcode'].setValue(this.formatPostcode(this.postcode.value));

    this.checkoutStep += 1;
  }

  toPayment() {
    this.checkoutStep += 1;
  }

  submitOrder() {
    this.paymentForm.controls['card'].setValue(this.formatCardNum(this.card.value));
    this.paymentForm.controls['expiry'].setValue(this.formatExpiry(this.expiry.value));
    this.paymentForm.controls['paymentPC'].setValue(this.formatPostcode(this.paymentPC.value));
    console.log(this.shipToForm.value)
    console.log(this.paymentForm.value)

    this.checkoutStep += 1;
  }

  /* changeCheckoutStep(move: string) {
    if (move == "next") {
      if (this.checkoutStep < 3) {
        this.checkoutStep += 1;

        if (this.checkoutStep == 1) {
          this.currentStore = this.storeSelectorService.getLocation();
          this.shipToForm.controls['postcode'].setValue(this.formatPostcode(this.postcode.value))
          //console.log(this.shipToForm)
          // this.geocodingService.getLocation(this.currentStore).subscribe((response: GeocoderResponse) => {
          //   console.log(response.results)
          // })
        }
      } else {
        this.checkoutStep = 0;
      }
      //(this.checkoutStep <= 3) ? this.checkoutStep += 1 : this.checkoutStep = 0;
    } else {
      (this.checkoutStep > 0) ? this.checkoutStep -= 1 : this.router.navigate(['/cart']);
    }
    
    console.log(this.checkoutStep);
  } */
}
