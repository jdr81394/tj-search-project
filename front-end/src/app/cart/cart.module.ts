import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
// import { BrowserModule } from '@angular/platform-browser';


import { CartComponent } from './cart.component';

@NgModule({
  declarations: [CartComponent],
  exports: [CartComponent],
  imports: [
    CommonModule
    // BrowserModule
  ]
})
export class CartModule { }
