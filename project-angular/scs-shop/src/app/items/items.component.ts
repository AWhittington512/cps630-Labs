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
}
