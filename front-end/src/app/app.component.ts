import { Component } from '@angular/core';
import { ItemsServiceService } from './items-service/items-service.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'front-end';


  cart: String[];
  basicSearch: String;
  result: String[]

  constructor(
    private itemsService: ItemsServiceService
  ) { 
    this.cart = [];
    this.basicSearch = '';
    this.result = [];
  }

  addToCart(item) {
    console.log('item is in cart:  ' ,item);
    this.cart.push(item);
    console.log("cart:: "  ,this.cart);
  }

  getItems() {
    console.log("basic search:  "  ,this.basicSearch);
    this.itemsService.getItems(this.basicSearch).subscribe(
      (res: String[]) => {
        this.result = res;
        console.log("this result:   "  ,this.result);
        return this.result;

      }
    )
  }

}
