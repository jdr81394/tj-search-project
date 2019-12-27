import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
// import { BrowserModule } from '@angular/platform-browser';

import {CartRoutingModule} from './cart-routing.module'

import { CartComponent } from './cart.component';

@NgModule({
  declarations: [CartComponent],
  exports: [CartComponent],
  imports: [
    CommonModule,
    CartRoutingModule
    // BrowserModule
  ]
})
export class CartModule { }
