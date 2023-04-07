import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-invoice',
  templateUrl: './invoice.component.html',
  styleUrls: ['./invoice.component.css']
})
export class InvoiceComponent {
  order: any;
  rows: any;

  constructor (
    private route: ActivatedRoute,
    private httpClient: HttpClient,
  ) {}

  ngOnInit() {
    this.route.queryParams.subscribe((result) => {
      this.order = result["order"];
      //console.log(this.order)

      this.httpClient.get('api/invoice/' + this.order)
        .subscribe(response => {
          this.rows = response;
        })
    })
  }
}
