import { Component } from '@angular/core';
import { ItemsServiceService } from './items-service/items-service.service';
import { Item } from './classes/item';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'front-end';


  cartVisible = false;
  searchVisible = true;
  cart: Item[];
  basicSearch: String;
  result: String[]

  constructor(
    private itemsService: ItemsServiceService
  ) { 
    this.cart = [];
    this.basicSearch = '';
    this.result = [];
  }

  changeStatus() {
    if(this.searchVisible == true) {
      this.searchVisible = false;
    } else {
      this.searchVisible = true;
    }
    if(this.cartVisible == true) {
      this.cartVisible = false;
    } else {
      this.cartVisible = true;
    }
  }

  addToCart(event, name) {
    // console.log(event);
    // console.log(event.srcElement.elements[0].valueAsNumber);
    // console.log(event.srcElement.elements[0].value);
    let quantity = event.srcElement.elements[0].valueAsNumber;
    // console.log(" name:  "  ,name);
    let item = new Item(name, quantity);
    // quantity = quantity.value;
    this.cart.push(item);
    console.log(" this cart:  "  ,this.cart);
  }

  getItems() {
    this.itemsService.getItems(this.basicSearch).subscribe(
      (res: String[]) => {
        this.result = res;
        return this.result;
      }
    )
  }

  removeItem(x) {
    this.cart.splice(x,1);
    console.log('this cart:'  ,this.cart);
  }

  checkout(event) {
    console.log(" in app compnoent");
    let textarea = event.srcElement.elements[0].value;
    console.log("textara:  " ,textarea);
    this.itemsService.sendEmail(this.cart, textarea).subscribe();
  }

}
